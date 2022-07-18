<?php
session_start();
if(!isset($_SESSION["sellerid"])){
header("Location:login.php");
exit(); }

?>