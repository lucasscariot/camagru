<?php
  $page = "Accueil";
  require_once("includes/config.php");
  if (!$_SESSION[id]) {
    header('location: login.php');
  }
  $user = getUser($mysqli, $_SESSION[id]);

  /* Select Last Pics */
  $query = mysqli_query($mysqli, "SELECT * FROM pics WHERE id = '".$_SESSION[id]."'");

  require_once("includes/head.php");
?>
<div class="row">
  <div class="w-9">
    <h1>Camagru</h1>
    <hr>
    <h2>Take your picture</h2>
    <br>
    <div class="camera">
      <p><video id="video" width="100%" autoplay="autoplay"></video></p>
      <p><input type="button" id="buttonSnap" value="Prendre une photo" disabled="disabled" onclick="snapshot()" /></p>
      <input type="button" id="buttonStart" value="Démarrer" disabled="disabled" onclick="start()" />
      <input type="button" id="buttonStop" value="Arrêter" disabled="disabled" onclick="stop()" />
      <h3>None</h3>
      <button>Changer de filtre !</button>
      <p><canvas id="canvas"></canvas></p>
    </div>
  </div>
  <div class="w-3">
    <div class="galery">
      <h1>Last Pics</h1>
      <hr>
      <?php while($pic = mysqli_fetch_assoc($query))
      {
        $pic[user] = getUser($mysqli, $pic[user]);
        ?>
        <div class="pic">
          <img src="<?php echo $pic[url]; ?>" height="100%" alt="<?php echo $pic[name]; ?>" />
          <div class="data">
            <p><strong><?php echo $pic[name]; ?></strong> by <a href="#"><?php echo $pic[user][name]; ?></a></p>
          </div>
        </div>
      <?php } ?>
    </div>
    <p class="clear"></p>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="js/camera.js"></script>
<?php require_once("includes/footer.php"); ?>
