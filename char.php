<?php
$query = 'SELECT
          # NETFLIX
          netflix.email AS emailNetflix,
          netflix.expiration AS expirationNetflix,
          # SPOTIFY
          spotify.email AS emailSpotify,
          spotify.expiration AS expirationSpotify

          FROM netflix LEFT JOIN spotify ON netflix.credit_id = spotify.card_id
          ';

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
# HTML
$i = 1; # init number
echo '
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" /><meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>Accounts</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Accounts</h2>
    <table class="table table-striped table-dark">
      <th>#</th>
      <th>Netflix Email</th>
      <th>Status</th>
      <th>Spotify Email</th>
      <th>Status</th>';
foreach($data as $data) {
  $expNetflix = strtotime($data['expirationNetflix']);
  $expSpotify = strtotime($data['expirationSpotify']);
  $today = strtotime('today');

  # NETFLIX STATUS
  if ($expNetflix < $today) {
    $expNetflix = 'Expired.';
  } else if ($expNetflix > $today) {
    $expNetflix = (($expNetflix - $today)/86400).' days left.';
  } else if ($expNetflix == $today) {
    $expNetflix = 'Expiring today.';
  }

  # SPOTIFY Status
  if ($expSpotify < $today) {
    $expSpotify = 'Expired.';
  } else if ($expSpotify > $today) {
    $daysLeft = ($expSpotify - $today)/86400;

    if ($daysLeft > 60) {
      $expSpotify = ($daysLeft - 60).' days left.';
    } else if ($daysLeft > 30) {
      $expSpotify = ($daysLeft - 30).' days left.';
    } else if ($daysLeft < 30) {
      $expSpotify = ($daysLeft).' days left.';
    }



    if ($expSpotify == 60 || $expSpotify == 30 || $expSpotify == $today) {
      $expSpotify = 'Expiring today.';
    }
  }

  echo '<tr>
          <td>'.$i.'</td>
          <td>'.$data['emailNetflix'].'</td>
          <td>'.$expNetflix.'</td>
          <td>'.$data['emailSpotify'].'</td>
          <td>'.$expSpotify.'</td>
        ';


$i++;
?>
