<?php

session_start();

$_SESSION[] = array();
//$_SESSION[]: for empty data from array
session_destroy();

header("Location:../index.php");
?>