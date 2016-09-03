<?php
  $page = "Login";
  require_once("includes/config.php");
  if ($_SESSION[id])
    header('location: index.php');

  $error = [];
  if ($_POST[submit] == "Login" && $_POST[id] && $_POST[password]) {
    if (!preg_match("/^[A-z0-9@.]+$/", $_POST[id])) {
      array_push($error, "Name mauvais format");
    }
    if (!$error) {
      $query = mysqli_query($mysqli, "SELECT * FROM users WHERE email = '".$_POST[id]."'");
      $user = mysqli_fetch_array($query);
      if (!$user) {
        array_push($error, "Inexistant user");
      }
      else if (hash('whirlpool', $_POST[password]) == $user[password]) {
        $_SESSION[id] = $user[id];
        header('location: index.php');
      }
      else {
        array_push($error, "Mot de passe incorrect");
      }
    }
  }
  else if ($_POST[submit]){
    array_push($error, "Tous les champs sont obligatoires");
  }
  require_once("includes/head.php");
?>
<div class="row">
  <div class="w-12">
    <?php require_once("includes/alert.php"); ?>
    <form class="box-form" action="" method="POST">
      <h1>Login</h1>
      <hr>
      <input type="text" name="id" placeholder="Email">
      <input type="password" name="password" value="" placeholder="Mot de passe">
      <input type="submit" name="submit" value="Login">
    </form>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>
