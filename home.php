<?php

$passcode = '';
if (isset($_POST['passcode'])) {
  $passcode = htmlentities($_POST['passcode']);
}
if ($passcode == 'test') {
  include('nflixandspify.php');
} else {
  echo 'wrong pass, you will be redirected to the log-in page in 3 sec';
  header('refresh:3;url=index.php');
}
