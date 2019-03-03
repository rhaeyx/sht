<?php
// if (!$passcode || !$passcode == 'test') {
//   echo 'UNAUTHORIZED.';
//   header('location:index.php');
// } else {
  require('config/config.php');
  require('config/db.php');

  $query = "SELECT
            netflix.email AS emailNetflix,
            netflix.password AS passwordNetflix,
      	    netflix.creation AS creationNetflix,
      	    netflix.expiration AS expirationNetflix,
            netflix.users AS usersNetflix,

            spotify.email AS emailSpotify,
            spotify.password AS passwordSpotify,
            spotify.creation AS creationSpotify,
            spotify.expiration AS expirationSpotify,
            spotify.users AS usersSpotify,

            card.phone, card.card_number, card.expiration, card.cvv, card.bal

            FROM netflix
            LEFT JOIN spotify
            ON netflix.credit_id = spotify.card_id
            LEFT JOIN card
            ON netflix.credit_id = card.id";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
// } // Close for else
?>

<?php include('inc/header.php'); ?>
  <div class="container">
    <h2>Home</h2>
      <table class="table table-striped table-dark">
        <th>#</th>
        <th>Netflix Email</th>
        <th>Spotify Email</th>
        <th>Phone Number</th>
        <?php $i = 1 ?>
          <?php foreach($data as $data) : ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#netflix<?php echo $i ?>">
                  <?php echo $data['emailNetflix'] ?>
                </button>
              </td>
              <td>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#spotify<?php echo $i ?>">
                  <?php echo $data['emailSpotify'] ?>
                </button></td>
              <td>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#card<?php echo $i ?>">
                  <?php echo $data['phone'] ?>
                </button>
              </td>
            </tr>
            <!-- NETFLIX MODAL -->
            <div class="modal fade" id="netflix<?php echo $i ?>" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title">Netflix</h3>
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                      <b>Email: </b><?php echo $data['emailNetflix'] ?><br />
                      <b>Password: </b><?php echo $data['passwordNetflix'] ?><br />
                      <b>Creation: </b><?php echo $data['creationNetflix'] ?><br />
                      <b>Expiration: </b><?php echo $data['expirationNetflix'] ?><br />
                      <b>Status: </b>
                        <?php
                        $exp = strtotime($data['expirationNetflix']);
                        $today = strtotime('today');

                        if ($exp < $today) {
                          echo "Expired";
                        } else if ($exp > $today) {
                          echo ($exp - $today)/86400 ." days left";
                        } else if ($exp == $today) {
                          echo "Expiring today.";
                        }; ?>
                      <br />
                      <b>User/s: </b><?php echo $data['usersNetflix'] ?><br />
                    </p>
                  </div>
                  <!-- <div class="modal-footer">
                    <button type="button" name="button" class="btn btn-primary">Edit</button>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- SPOTIFY MODAL -->
            <div class="modal fade" id="spotify<?php echo $i ?>" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content jumbotron">
                  <div class="modal-header">
                    <h3 class="modal-title">Spotify</h3>
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                      <b>Email: </b><?php echo $data['emailSpotify'] ?><br />
                      <b>Password: </b><?php echo $data['passwordSpotify'] ?><br />
                      <b>Creation: </b><?php echo $data['creationSpotify'] ?><br />
                      <b>Expiration: </b><?php echo $data['expirationSpotify'] ?><br />
                      <b>Status: </b>
                        <?php
                        $exp = strtotime($data['expirationSpotify']);
                        $today = strtotime('today');

                        if ($exp < $today) {
                          echo "Expired";
                        } else if ($exp > $today) {
                          echo ($exp - $today)/86400 ." days left";
                        } else if ($exp == $today) {
                          echo "Expiring today.";
                        }; ?>
                      <br />
                      <b>User/s: </b><?php echo $data['usersSpotify'] ?><br />
                    </p>
                  </div>
                  <!-- <div class="modal-footer">
                    <button class="btn btn-primary" type="button" name="button"></button>
                  </div> -->
                </div>
              </div>
            </div>
            <!-- CARD MODAL -->
            <div class="modal fade" id="card<?php echo $i ?>" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content jumbotron">
                  <div class="modal-header">
                    <h3 class="modal-title">Card Details</h3>
                    <button type="button" class="close" data-dismiss="modal">
                      <span>&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                      <b>Phone: </b><?php echo $data['phone'] ?><br />
                      <b>Card Number: </b><?php echo $data['card_number'] ?><br />
                      <b>Expiration: </b><?php echo $data['expiration'] ?><br />
                      <b>CVV: </b><?php echo $data['cvv'] ?><br />
                      <b>Balance: </b>P<?php echo $data['bal'] ?><br />
                    </p>
                  </div>
                </div>
              </div>
            </div>

          <?php $i++; endforeach; ?>

      </table>
<?php include('inc/footer.php') ?>
