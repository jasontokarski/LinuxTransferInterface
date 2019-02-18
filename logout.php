<?php
  session_start();
  unset($_SESSION);
  session_destroy();
  header("Location: index.php");
  echo "You have successfully logged out!";
?>
