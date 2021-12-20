<?php
session_start();
if(isset($_SESSION['username'])){
  unset($_SESSION['username']);
  unset($_SESSION['user']);
  session_destroy();
}
header('Location: index.php');
?>
