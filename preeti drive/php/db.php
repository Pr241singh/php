<?php
 
$db = new mysqli("localhost","root","","preetidrive");
if($db->connect_error)
{
	die("Connection failed");
}
//if error die execute and more code will not

?>