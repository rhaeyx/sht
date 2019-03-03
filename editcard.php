<?php
  require('config/config.php');
  require('config/db.php');

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $query = 'SELECT * FROM card WHERE id = '.$id;

  $result = mysqli_query($conn, $query);

  $card = mysqli_fetch_assoc($result);

  if(isset($_POST['submit'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    $expiration = mysqli_real_escape_string($conn, $_POST['expiration']);
    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
    $bal = mysqli_real_escape_string($conn, $_POST['bal']);
    $card_id = mysqli_real_escape_string($conn, $_POST['card_id']);

    $query = "UPDATE card SET
              phone = '$phone',
              card_number = '$card_number',
              expiration = '$expiration',
              cvv = '$cvv',
              bal = '$bal'
              WHERE id = {$card_id}";

    if(mysqli_query($conn, $query)) {
      header('Location: '.ROOT_URL.'');
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }

  if(isset($_POST['delete'])) {
    $card_id = mysqli_real_escape_string($conn, $_POST['card_id']);

    $query = "DELETE FROM card WHERE id = {$card_id}";

    if(mysqli_query($conn, $query)) {
      header('Location: '.ROOT_URL.'');
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }
  }

  mysqli_free_result($result);
  mysqli_close($conn);
?>
<?php include('inc/header.php'); ?>
  <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$id ?>" method="post">
    <div class="row">
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Phone Number</label>
        <input class="form-control" type="text" name="phone" value="<?php echo $card['phone'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Card Number</label>
        <input class="form-control" type="text" name="card_number" value="<?php echo $card['card_number'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Expiration</label>
        <input class="form-control" type="text" name="expiration" value="<?php echo $card['expiration'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">CVV</label>
        <input class="form-control" type="text" name="cvv" value="<?php echo $card['cvv'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Balance</label>
        <input class="form-control" type="text" name="bal" value="<?php echo $card['bal'] ?>">
      </div>
    </div>
    <input type="hidden" name="card_id" value="<?php echo $card['id'] ?>">
    <div class="row">
      <button class="btn btn-primary col-md-3" type="submit" name="submit">Submit edit</button>
      <button class="btn btn-danger col-md-3 offset-md-6" type="delete" name="delete">Delete</button>
    </div>
    </form>
  </div>
