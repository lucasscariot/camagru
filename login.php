<?php require_once("includes/head.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $site; ?> - Login</title>
  <link rel="stylesheet" href="css/global.css" media="screen" title="no title" charset="utf-8">
  <link rel="stylesheet" href="css/form.css" media="screen" title="no title" charset="utf-8">
</head>
<?php require_once("includes/nav.php"); ?>
</nav>
<body>
  <div class="container">
      <form class="box-form" action="index.php" method="post">
        <h1>Login</h1>
        <hr>
        <input type="text" name="id" value="" placeholder="Identifiant">
        <input type="password" name="password" value="" placeholder="Mot de passe">
        <input type="submit" name="name" value="Login">
      </form>
  </div>
</body>
</html>
