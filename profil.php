<?php
  require_once("includes/head.php");
  if (!$_SESSION[id]) {
    header('location: login.php');
  }
  $user = getUser($mysqli, $_SESSION[id]);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $site; ?> - Profil</title>
  <link rel="stylesheet" href="css/global.css" media="screen" charset="utf-8">
</head>
<?php require_once("includes/nav.php"); ?>
</nav>
<body>
  <div class="main">
    <div class="container">
      <h1>Camagru</h1>
      <hr>
      <h2>Profil</h2>
      <p><a href="#">- Update -</a></p>
      <p>
        <strong>Identifiant</strong> : <?php echo $user[name] ?><br>
        <strong>Email</strong> : <?php echo $user[email] ?><br>
      </p>
    </div>
  </div>
  <div class="sidebar">
    <div class="container">
      <h2>Last Pics</h2>
    </div>
  </div>
</body>
</html>
