<?php
  require('../config/config.php');
  require('../config/db.php');

  $query = 'SELECT * FROM card ORDER BY id';

  $result = mysqli_query($conn, $query);

  $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($conn);

  if(isset($_POST['submit'])){
    $card_id = $_POST['card_id'];

    header('Location: '.ROOT_URL.'editcard.php?id='.$card_id);
  }
?>

<?php include('../inc/header.php'); ?>
  <div class="container">
      <h2>Cards</h2>
  </table>
  <table class="table table-striped table-dark">
  <th>#</th>
  <th>Phone</th>
  <th>Number</th>
  <th>Expiration</th>
  <th>CVV</th>
  <th>Balance</th>
  <th></th>

  <?php $i = 1; $totalBal = 0.00;foreach($accounts as $card) : ?>
    <tr>
      <td><?php echo $i; $i++ ?></td>
      <td><?php echo $card['phone'] ?></td>
      <td><?php echo $card['card_number'] ?></td>
      <td><?php echo $card['expiration'] ?></td>
      <td><?php echo $card['cvv'] ?></td>
      <td>P <?php echo $card['bal'] ?></td>
      <td>
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <input type="hidden" name="card_id" value="<?php echo $card['id'] ?>">
          <button class="btn btn-secondary" name="submit" type="submit" value="submit">Edit / Delete</button>
        </form>
      </td>
    </tr>
  <?php $totalBal += $card['bal']; endforeach; ?>

    <div class="modal fade" id="balance" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content jumbotron">
          <div class="modal-header">
            <h3 class="modal-title">Total Balance</h3>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1>P <?php echo $totalBal ?></h1>
            </p>
          </div>
        </div>
      </div>
    </div>

  </table>
  <div class="row">
    <button class="btn btn-secondary col-md-3 offset-md-7" type="button" data-toggle="modal" data-target="#balance">Total Balance</button>
  </div>
<?php include('../inc/footer.php') ?>
