<?php
session_start();
if(!isset($_SESSION["managerid"])){
header("Location:login.php");
exit(); }

?>