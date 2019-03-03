<?php
# EDIT FOR SPOTIFY and NETFLIX
require('config/config.php');
require('config/db.php');

$id = mysqli_real_escape_string($conn, $_GET['id']);
$type = mysqli_real_escape_string($conn, $_GET['type']);

$query = 'SELECT * FROM '.$type.' WHERE id = '.$id;

$result = mysqli_query($conn, $query);

$account = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password =mysqli_real_escape_string($conn, $_POST['password']);
  $creation = mysqli_real_escape_string($conn, $_POST['creation']);
  $expiration = mysqli_real_escape_string($conn, $_POST['expiration']);
  $users = mysqli_real_escape_string($conn, $_POST['users']);
  $account_id = mysqli_real_escape_string($conn, $_POST['account_id']);

  $query = "UPDATE $type SET
            email='$email',
            password='$password',
            creation='$creation',
            expiration='$expiration',
            users='$users'
            WHERE id = {$account_id}";

  if(mysqli_query($conn, $query)){
    # ROOT_URL is localhost/sandbox/
    header('Location: '.ROOT_URL.$type.'');
  } else {
    echo 'ERROR: '. mysqli_error($conn);
  }
}

if(isset($_POST['delete'])) {
  $account_id = mysqli_real_escape_string($conn, $_POST['account_id']);

  $query = "DELETE FROM $type WHERE id = {$account_id}";

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
    <form action="<?php echo $_SERVER['PHP_SELF'].'?type='.$type.'&id='.$id ?>" method="post">
    <div class="row">
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Email</label>
        <input class="form-control" type="text" name="email" value="<?php echo $account['email'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Password</label>
        <input class="form-control" type="text" name="password" value="<?php echo $account['password'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Creation</label>
        <input class="form-control" type="text" name="creation" value="<?php echo $account['creation'] ?>">
      </div>
      <div class="form-group col-md-3">
        <label class="font-weight-bold">Expiration</label>
        <input class="form-control" type="text" name="expiration" value="<?php echo $account['expiration'] ?>">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label class="font-weight-bold">Users</label>
          <input class="form-control" type="text" name="users" value="<?php echo $account['users'] ?>">
      </div>
    </div>
    <input type="hidden" name="account_id" value="<?php echo $account['id'] ?>">
    <div class="row">
      <button class="btn btn-primary col-md-3"type="submit" name="submit">Submit edit</button>
      <button class="btn btn-danger col-md-3 offset-md-6" type="delete" name="delete">Delete</button>
    </div>
    </form>
  </div>
