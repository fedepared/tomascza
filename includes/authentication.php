<?php
session_start();

if(empty($_SESSION["medicoId"]) || ($_SESSION["medicoId"] == 0)){
	header("location: login.php");	
}

$medicoId = (int) $_SESSION["medicoId"];

// echo("<p>$medicoId</p>");
?>
