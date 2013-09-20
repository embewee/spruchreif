<!DOCTYPE html>
<html>
<head>
<title>Der Papierjosef</title>
</head>
<body>
<h2>Papierjosef</h2>
Das ist der Papierjosef.
<?php
include('analysis.php');

if(!empty($_FILES))
{
	echo "<div style='width:80%; margin:auto;border: 1px solid black;'>";

	$contents = file_get_contents($_FILES['upload']['tmp_name']);
	if(strlen($contents) > 400) {
		echo substr($contents,0,400)."...\n</div>";
	}else{
		echo $contents;
	}

	echo "</div>\n";
	analyse($contents);
} else {
?><p>
Er ist sehr gut!

<form action="index.php" method="post" enctype="multipart/form-data">
	<label for="upload">Datei ausw&auml;len:</label>
	<input name="upload" type="file" size="50" accept="text/*" />
	<input type="submit" value="Absenden"/>
</form>
<?php
}
?>
</body>
</html>
