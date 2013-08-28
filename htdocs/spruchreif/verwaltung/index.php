<html>

<head>
<script src="md5.js"></script>
<script language="javascript">

  function hash() {
    str = document.login.pwd.value;
    document.login.pwd.value = MD5(str);
  }

</script>

</head>

<body>

<form name="login" action="verwaltung.php" method="POST">
	<label for="email">Email:</label>	
	<input type="text" name="email" id="email"/>
	<label for="pwd">Kennwort:</label>	
	<input type="text" name="pwd" id="pwd"/>
	<input type="submit" onClick="hash(); return false;" value="Anmelden"/> <!-- return false: danach wird das submit noch ausgeführt ~! -->
</form>

</body>
</html>
