<?php
  $page = "Accueil";
  require_once("includes/config.php");
  if (!$_SESSION[id]) {
    header('location: login.php');
  }
  $user = getUser($mysqli, $_SESSION[id]);
  require_once("includes/head.php")
?>
<div class="row">
  <div class="w-9">
    <h1>Camagru</h1>
    <hr>
    <h2>Take your picture</h2>
    <br>
    <div class="camera">
      <video width="100%"></video>
      <h3>None</h3>
      <button>Changer de filtre !</button>
    </div>
  </div>
  <div class="w-3">
    <div class="galery">
      <h1>Last Pics</h1>
      <hr>
      <div class="pic">
        <img src="http://lorempicsum.com/up/350/200/1" height="100%" alt="" />
        <div class="data">
          <p><strong>Hello</strong> by <a href="#">Lucas</a></p>
        </div>
      </div>
      <div class="pic">
        <img src="http://lorempicsum.com/up/350/200/2" height="100%" alt="" />
        <div class="data">
          <p><strong>Test</strong> by <a href="#">Lucas</a></p>
        </div>
      </div>
      <div class="pic">
        <img src="http://lorempicsum.com/up/350/200/3" height="100%" alt="" />
        <div class="data">
          <p><strong>Boom</strong> by <a href="#">Lucas</a></p>
        </div>
      </div>
    </div>
    <p class="clear"></p>
  </div>
  <script src="js/camera.js"></script>
<?php require_once("includes/footer.php"); ?>
