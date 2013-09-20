<?php
require 'hash.php';

// Create connection
$con=mysqli_connect("localhost","root","Media11","spruchreif");
$table = "autoren";

// Check connection
if (mysqli_connect_errno($con)) 
{
	echo "Datenbankfehler"; //TODO
}

if(!empty($_GET)){
	$name=$_GET['name'];
	$login_pwd=$_GET['pwd'];
	
} else {
	echo "Invalide Argumente";
	return;
}
$sqlCheckRes = mysqli_query($con,"SELECT pwd FROM ".$table." WHERE name = '".$name."'");

if (mysqli_errno($con)) {
	echo mysqli_error($con);
	return;
} else {
	$row = mysqli_fetch_row($sqlCheckRes);
	$db_pwd = $row[0];
	
	echo $login_pwd . " LOGIN<br>";
	echo $db_pwd . " DB<br>";
	
	echo "validate password: " . validate_password($login_pwd, $db_pwd);
	
}

//fullfil registration / set session

/*
if() {
	echo "Registrierung erfolgreich";
} else {
	echo "Registrierung abgebrochen";
}
* */

mysqli_close($con);
?> 
