<?php
// if(!$passcode || !$passcode == 'mIkdLzoS') {
//   header('location: ../');
// } else {

  require('../config/config.php');
  require('../config/db.php');

  $query = 'SELECT * FROM netflix ORDER BY id';

  $result = mysqli_query($conn, $query);

  $accounts = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($conn);

  if(isset($_POST['submit'])){
    $type = $_POST['type'];

    $account_id = $_POST[''.$type.'_id'];

    header('Location: '.ROOT_URL.'edit.php?type='.$type.'&id='.$account_id);
  }
// } // Close else.
?>

<?php include('../inc/header.php'); ?>
  <div class="container">
    <h2 class="netflix">Netflix</h2>
      <table class="table table-striped table-dark">
        <th>#</th>
        <th>Email</th>
        <th>Password</th>
        <th>Creation</th>
        <th>Expiration</th>
        <th>Status</th>
        <th>User/s</th>
        <th></th>
          <?php $i = 1; foreach($accounts as $account) : ?>
            <tr>
              <td><?php echo $i; $i++ ?></td>
              <td><?php echo $account['email'] ?></td>
              <td><?php echo $account['password'] ?></td>
              <td><?php echo $account['creation'] ?></td>
              <td><?php echo $account['expiration'] ?></td>
              <td>
                <?php
                  $exp = strtotime($account['expiration']);
                  $today = strtotime('today');

                  if ($exp < $today) {
                    echo "Expired";
                  } else if ($exp > $today) {
                    echo ($exp - $today)/86400 ." days left";
                  } else if ($exp == $today) {
                    echo "Expiring today.";
                  };
                ?>
              </td>
              <td><?php echo $account['users'] ?></td>
              <td>
                <form class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                  <input type="hidden" name="netflix_id" value="<?php echo $account['id'] ?>">
                  <input type="hidden" name="type" value="netflix">
                  <button class="btn btn-secondary" name="submit" type="submit" value="submit">Edit / Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>

      </table>
