<?php
if ($error) { ?>
  <div class="message-box error">
    <?php print_r($error); ?>
  </div>
  <?php
}
if ($success) { ?>
  <div class="message-box success">
    <?php echo $success; ?>
  </div>
<?php
}
?>
