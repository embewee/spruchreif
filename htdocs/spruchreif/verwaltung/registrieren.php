<html>

<head>

<script src="md5.js"></script>
<script language="javascript">

	function register() {
		pwd = document.login.pwd.value;
		pwdval = document.login.pwdval.value;
		email = document.login.email.value;

		if (isValidEmail(email)) {
			//ok
		} else {
			document.write('Inkorrekte Email-Adresse');
			return;
		}

		if (pwd == pwdval) {
			saltedPwd = email + pwd;
			hash(saltedPwd);
		} else {
			document.write('Passwörter stimmen nicht überein');
		}
	}

	function isValidEmail(str) {
		return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
	}

  function hash(saltedPwd) {
	document.write(saltedPwd + '\n');

	hashedSaltedPwd = MD5(saltedPwd);

	document.write(hashedSaltedPwd);
  }
</script>



<?php
	require 'hash.php';
?>

</head>

<body>

<form name="login" action="registrieren.php" method="POST">
	<label for="email">Email:</label>	
	<input type="text" name="email" id="email"/>
	<label for="pwd">Kennwort:</label>	
	<input type="text" name="pwd" id="pwd"/>
	<label for="pwdval">Kennwort erneut eingeben:</label>	
	<input type="text" name="pwdval" id="pwdval"/>
	<input type="submit" onClick="register(); return false;" value="Registrieren"/> <!-- return false: danach wird das submit noch ausgeführt ~! -->
</form>

<a href="anmelden.php">Anmelden</a> 

</body>
</html>
