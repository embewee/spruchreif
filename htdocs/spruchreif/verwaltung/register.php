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
	$email=$_GET['email'];
	$pwd=$_GET['pwd'];
	
} else {
	echo "Invalide Argumente";
	return;
}

//check name / do not allow a name twice

$sqlCheckRes = mysqli_query($con,"SELECT COUNT(*) FROM ".$table." WHERE name = '".$name."'");

if (mysqli_errno($con)) {
	echo mysqli_error($con);
	return;
} else {
	$row = mysqli_fetch_row($sqlCheckRes);
	$count = $row[0];
}

if($count > 0 ) { //abort
	echo "Benutzername/Email existiert bereits. Registrierung abgebrochen.";
	return;
}

//fullfil registration / insert into database

//result format: algorithm:iterations:salt:hash
$hashRes = create_hash($pwd);
list($algorithm, $iterations, $salt, $hash) = explode(":", $hashRes);

//$sqlInsertRes = mysqli_query($con,"INSERT INTO " . $table . " (name, mail, pwd, server_salt) VALUES ('" .
//	$name ."','".$email."','".$hash."','".$salt."')");

$sqlInsertRes = mysqli_query($con,"INSERT INTO " . $table . " (name, mail, pwd) VALUES ('" .
	$name ."','".$email."','".$hashRes."')");

if($sqlInsertRes == 1) {
	echo "Registrierung erfolgreich";
} else {
	echo "Registrierung abgebrochen";
}

mysqli_close($con);
?> 
