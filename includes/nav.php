<?php
  if ($_SESSION[id]) {
    require_once("includes/log_nav.php");
  }
  else {
    require_once("includes/nlog_nav.php");
  }
