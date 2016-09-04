<?php
  require_once("includes/config.php");
  if (!$_SESSION[id] || !$_POST[canvasData]) {
    header('location: login.php');
  }
  $user = getUser($mysqli, $_SESSION[id]);


  $upload_dir = "upload/";
  $img = $_POST[canvasData];
  $img = str_replace('data:image/png;base64,', '', $img);
  $img = str_replace(' ', '+', $img);
  $data = base64_decode($img);
  $file = $upload_dir . $user[name]. "_" . mktime() . ".png";
  $success = file_put_contents($file, $data);
  $query = mysqli_query($mysqli, "INSERT INTO `pics` (`name`, `user`, `url`, `date`) VALUES ('-','.$user[id].', '".$file."', '".getdate()[0]."')");
  $success = 'Account Created';
  print $success ? $file : 'Unable to save the file.';
?>
