<?php
  require('config/config.php');
  require('config/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Netflix & Spotify - Passcode</title>
</head>
<body>
  <div style="margin-top: 150px;"></div>
  <div style="text-align: center;">
  <form class="" action="home.php" method="post">
    <label for="password">Passcode</label>
    <input type="password" name="passcode">
    <button type="submit" name="submit">GO</button>
  </form>
  </div>
</body>
</html>
