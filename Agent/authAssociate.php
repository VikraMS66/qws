<?php
session_start();
if(!isset($_SESSION["associateid"])){
header("Location:login.php");
exit(); }

?>