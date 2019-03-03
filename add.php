<?php
  require('config/config.php');
  require('config/db.php');

  if(isset($_POST['submit'])){
    // CARD INFO
    $cardPhone = mysqli_real_escape_string($conn, $_POST['cardPhone']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['cardNumber']);
    $cardExpiration = mysqli_real_escape_string($conn, $_POST['cardExpiration']);
    $cardCVV = mysqli_real_escape_string($conn, $_POST['cardCVV']);

    $queryCard = "INSERT INTO card(phone, card_number, expiration, cvv)
              VALUES('$cardPhone', '$cardNumber', '$cardExpiration', '$cardCVV')";

    if(mysqli_query($conn, $queryCard)){
      header('Location: '.ROOT_URL.'');
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }

    // Get ID of CARD

    $queryID = "SELECT id FROM card WHERE phone = $cardPhone";

    $result = mysqli_query($conn, $queryID);
    $data = mysqli_fetch_assoc($result);

    $cardID = $data['id'];

    echo $cardID;

    // NETFLIX INFO
    $emailNetflix = mysqli_real_escape_string($conn, $_POST['emailNetflix']);
    if(!$emailNetflix) { $emailNetflix = "To be created."; };
    $passwordNetflix =mysqli_real_escape_string($conn, $_POST['passwordNetflix']);
    $creationNetflix = mysqli_real_escape_string($conn, $_POST['creationNetflix']);
    $expirationNetflix = mysqli_real_escape_string($conn, $_POST['expirationNetflix']);
    $usersNetflix = mysqli_real_escape_string($conn, $_POST['usersNetflix']);
    $credit_id = $cardID;

    $queryNetflix = "INSERT INTO netflix(email, password, creation, expiration, users, credit_id)
              VALUES('$emailNetflix', '$passwordNetflix', '$creationNetflix', '$expirationNetflix', '$usersNetflix', '$credit_id')";

    if(mysqli_query($conn, $queryNetflix)){
      header('Location: '.ROOT_URL.'');
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }

    // SPOTIFY INFO
    $emailSpotify = mysqli_real_escape_string($conn, $_POST['emailSpotify']);
    if(!$emailSpotify) { $emailSpotify = "To be created."; };
    $passwordSpotify =mysqli_real_escape_string($conn, $_POST['passwordSpotify']);
    $creationSpotify = mysqli_real_escape_string($conn, $_POST['creationSpotify']);
    $expirationSpotify = mysqli_real_escape_string($conn, $_POST['expirationSpotify']);
    $userSpotify = mysqli_real_escape_string($conn, $_POST['userSpotify']);
    $card_id = $cardID;

    $querySpotify = "INSERT INTO spotify(email, password, creation, expiration, users, card_id)
              VALUES('$emailSpotify', '$passwordSpotify', '$creationSpotify', '$expirationSpotify', '$userSpotify', '$card_id')";

    if(mysqli_query($conn, $querySpotify)){
      header('Location: '.ROOT_URL.'');
    } else {
      echo 'ERROR: '. mysqli_error($conn);
    }

    mysqli_free_result($result);
    mysqli_close($conn);
  }
?>

<?php include('inc/header.php'); ?>
  <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="row border-3">
      <div class="col-md-4">
        <h4>NETFLIX</h4>
        <div class="form-group col-md-4">
          <label>Email</label>
          <input type="text" name="emailNetflix">
        </div>
        <div class="form-group col-md-4">
          <label>Password</label>
          <input type="text" name="passwordNetflix">
        </div>
        <div class="form-group col-md-4">
          <label>Creation</label>
          <input type="text" name="creationNetflix">
        </div>
        <div class="form-group col-md-4">
          <label>Expiration</label>
          <input type="text" name="expirationNetflix">
        </div>
        <div class="form-group col-md-4">
          <label>User/s</label>
          <input type="text" name="usersNetflix">
        </div>
      </div>
      <div class="col-md-4">
        <h4>SPOTIFY</h4>
        <div class="form-group col-md-4">
          <label>Email</label>
          <input type="text" name="emailSpotify">
        </div>
        <div class="form-group col-md-4">
          <label>Password</label>
          <input type="text" name="passwordSpotify">
        </div>
        <div class="form-group col-md-4">
          <label>Creation</label>
          <input type="text" name="creationSpotify">
        </div>
        <div class="form-group col-md-4">
          <label>Expiration</label>
          <input type="text" name="expirationSpotify">
        </div>
        <div class="form-group col-md-4">
          <label>User/s</label>
          <input type="text" name="userSpotify">
        </div>
      </div>
      <div class="col-md-4">
        <h4>CARD DETAILS</h4>
        <div class="form-group col-md-4">
          <label>Phone</label>
          <input type="text" name="cardPhone">
        </div>
        <div class="form-group col-md-4">
          <label>Card</label>
          <input type="text" name="cardNumber">
        </div>
        <div class="form-group col-md-4">
          <label>Expiration</label>
          <input type="text" name="cardExpiration">
        </div>
        <div class="form-group col-md-4">
          <label>CVV</label>
          <input type="text" name="cardCVV">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 offset-md-8">
        <button type="submit" name="submit" class="btn btn-primary">Add account</button>
      </div>
    </div>
    </form>
  </div>
