<?php
  require_once("includes/head.php");
  if ($_SESSION[id])
    header('location: index.php');

  $error = [];
  if ($_POST[submit] == "Register" && $_POST[name] && $_POST[email] && $_POST[password]) {
    if (!preg_match("/^[A-z0-9]+@[.A-z0-9]+$/", $_POST[email])) {
      array_push($error, "Email incorrect");
    }
    if (!preg_match("/^[A-z0-9]+$/", $_POST[name])) {
      array_push($error, "Name mauvais format");
    }
    $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '".$_POST[email]."'");
    $user = mysqli_fetch_array($query);
    if ($user) {
      array_push($error, "Email déjà utilisé");
    }
    if (!$error) {
      $query = mysqli_query($mysqli, "INSERT INTO `users` (`name`, `email`, `password`) VALUES ('".$_POST[name]."','".$_POST[email]."', '".hash('whirlpool', $_POST[password])."')");
      echo 'ok';
    }
  }
  else if ($_POST[submit]){
    array_push($error, "Tout les champs sont obligatoires");
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $site; ?> - Register</title>
  <link rel="stylesheet" href="css/global.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/form.css" media="screen" title="no title" charset="utf-8">
</head>
<?php require_once("includes/nav.php"); ?>
</nav>
<body>
  <div class="container">
    <div class="message-box error">
      <?php print_r($error); ?>
    </div>
      <form class="box-form" action="" method="post">
        <h1>Register</h1>
        <hr>
        <input type="text" name="name" value="<?php echo $_POST[name]; ?>" placeholder="Identifiant">
        <input type="email" name="email" value="<?php echo $_POST[email]; ?>" placeholder="Email">
        <input type="password" name="password" value="" placeholder="Mot de passe">
        <input type="submit" name="submit" value="Register">
      </form>
  </div>
</body>
</html>
