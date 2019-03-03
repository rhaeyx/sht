<?php
$passcode = '';
if(isset($_POST['passcode'])) {
  $passcode = $_POST['passcode'];
}

if($passcode == 'mIkdLzoS') {
  include('nflix.php');
} else {
  header('location:../');
}
 ?>
