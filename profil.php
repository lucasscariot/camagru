<?php
  $page = "Profil";
  require_once("includes/config.php");
  if (!$_SESSION[id]) {
    header('location: login.php');
  }
  $user = getUser($mysqli, $_SESSION[id]);
  require_once("includes/head.php")
?>
<div class="row">
  <div class="w-6">
    <h1>Camagru</h1>
    <hr>
    <h2>Profil</h2>
    <p style="font-size: 18px;">
      <strong>Identifiant</strong> : <?php echo $user[name] ?><br>
      <strong>Email</strong> : <?php echo $user[email] ?><br>
    </p>
    <hr>
    <p class="clear"></p>
  </div>
  <div class="w-6">
    <h2>Update</h2>
    <form class="box-form" style="margin: 0px;" action="" method="post">
      <input type="text" name="name" value="<?php echo $user[name]; ?>" placeholder="Name">
      <input type="email" name="email" value="<?php echo $user[email]; ?>" placeholder="Email">
      <input type="submit">
    </form>
    <p class="clear"></p>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>
