<html>

<head>

<script src="md5.js"></script>
<script language="javascript">

	function logIn() {
		email = document.login.email.value;
		pwd = document.login.pwd.value;
		
		saltedPwd = email + pwd
		hashedSaltedPwd = MD5(saltedPwd);
		
		name = email; //here
		
		requestLogin(name, hashedSaltedPwd);
	}

	function requestLogin(name, pwd) {
		var ajax = getRequest();
		
		ajax.onreadystatechange = function(){
			if(ajax.readyState == 4){
				document.getElementById('output').innerHTML = ajax.responseText; //refers to span-element
			}
		}
		
		ajax.open("GET", "login_server.php?name=" + name + "&pwd=" + pwd, true); 
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

<form name="login" action="anmelden.php" method="POST">
	<label for="email">Email=Benutzername:</label>	
	<input type="text" name="email" id="email"/>
	<label for="pwd">Kennwort:</label>	
	<input type="password" name="pwd" id="pwd"/>
	<input type="submit" onClick="logIn(); return false;" value="Anmelden"/> <!-- return false: danach wird das submit noch ausgeführt ~! -->
</form>

<a href="registrieren.php">Registrieren</a> <br>

<span id="output"></span>

</body>
</html>
