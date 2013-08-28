<html>
<head>
<link rel="stylesheet" type="text/css" href="huebsch.css">
</head>
<body>

<?php
// Create connection
$con=mysqli_connect("localhost","root","Media11","spruchreif");

// Check connection
if (mysqli_connect_errno($con)) 
{
	echo "Fehler"; //TODO
}

//if(!empty($_POST))
//{
//	mysqli_query($con,"INSERT INTO Persons (FirstName, LastName, Age) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[age]')");
//}

if(!empty($_GET)){
	$d=$_GET['date'];
} else {
	$d=date("Y-m-d");
}

$result = mysqli_query($con,"SELECT name as autor, spruch FROM sprueche, autoren WHERE autoren.id = sprueche.autor_id AND gezeigt = DATE '" . $d . "'");
while($row = mysqli_fetch_array($result))
{
?>
<div class="spruch"><?php echo $row['spruch'];?></div>
<div class="autor"><?php echo $row['autor'] ;?></div>
<?php
}


mysqli_close($con);
$yesterday = strtotime ( '-1 day' , strtotime ( $d ) ) ;
$tomorrow = strtotime ( '+1 day' , strtotime ( $d ) ) ;
?> 
<div id="links">
	<a href=<?php echo "index.php?date=" . date ( 'Y-m-d' , $yesterday ); ?> >&lt;</a>&nbsp;<a href="index.php" >Heute</a>&nbsp;<a href=<?php echo "index.php?date=" . date ( 'Y-m-d' , $tomorrow ); ?>>&gt;</a>
</div>

</body>
</html> 
