<html>

<head>

<script src="md5.js"></script>
<script language="javascript">

	function register() {
		email = document.login.email.value;
		pwd = document.login.pwd.value;
		pwdval = document.login.pwdval.value;

		if(checkInput(email, pwd, pwdval)) {
			saltedPwd = email + pwd
			hashedSaltedPwd = MD5(saltedPwd);
			requestRegistration(email, hashedSaltedPwd);
			
		} else {
			document.write('Nicht registriert');
		}
	}

	function checkInput(email, pwd, pwdval) {
		if (! isValidEmail(email)) {
			document.write('Inkorrekte Email-Adresse');
			return false;
		}

		if((pwd == null) || (pwd.length < 6)) {
			document.write('Das Passwort muss mindestens 6 Zeichen lang sein');
			return false;
		}
		
		if(pwdval == null) {
			document.write('Passwort erneut eingeben');
			return false;
		}

		if (pwd != pwdval) {
			document.write('Passwörter stimmen nicht überein');
			return false;
		}
	
		return true;
	}

	function isValidEmail(str) {
		return (str.indexOf(".") > 2) && (str.indexOf("@") > 0);
	}

	function requestRegistration(email, pwd) {
		var ajax = getRequest();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				document.getElementById('output').innerHTML = ajax.responseText; //refers to span-element
			}
		}
		
		ajax.open("GET", "register.php?name=" + email + "&email=" + email + "&pwd=" + pwd, true); //TODO: PUT!
		ajax.send(null);
	}

	function getRequest() {
		var req = false;
		try{
		    // most browsers
		    req = new XMLHttpRequest();
		} catch (e){
		    // IE
		    try{
		        req = new ActiveXObject("Msxml2.XMLHTTP");
		    } catch (e) {
		        // try an older version
		        try{
		            req = new ActiveXObject("Microsoft.XMLHTTP");
		        } catch (e){
		            return false;
		        }
		    }
		}
		return req;
	}

</script>

</head>

<body>

<form name="login" action="registrieren.php" method="POST">
	<label for="email">Email=Benutzername:</label>	
	<input type="text" name="email" id="email"/>
	<label for="pwd">Kennwort:</label>	
	<input type="password" name="pwd" id="pwd"/>
	<label for="pwdval">Kennwort erneut eingeben:</label>	
	<input type="password" name="pwdval" id="pwdval"/>
	<input type="submit" onClick="register(); return false;" value="Registrieren"/> <!-- return false: danach wird das submit noch ausgeführt ~! -->
</form>

<a href="anmelden.php">Anmelden</a> 

<span id="output"></span>

</body>
</html>
