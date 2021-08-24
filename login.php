<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
require_once("../sConn.php");

if (isset($_POST['kadi'])||isset($_GET['kadi'])) {
  if (isset($_POST['kadi'])){
  $loginUsername=$_POST['kadi'];
  $password=$_POST['sifre'];
  }
  if (isset($_GET['kadi'])){
  $loginUsername=$_GET['kadi'];
  $password=$_GET['sifre'];
  }
	
  $index = "index.php";
  $login = "login.php";
	
	$pd=new rz_PDO();
	$list=$pd->Sorgu("SELECT * FROM kullanici where kadi='$loginUsername' and sifre='$password'"); 
	//print_r($list);
	
  if (count($list)==0) {
	header("Location: ". $login );
  }
  else {
		
		if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
		$_SESSION['MM_Username'] = $loginUsername;
		$_SESSION['MM_Password'] = $password;
		header("Location: " . $index );
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="login.php" method="post">
  

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input id="uname" type="text" placeholder="Enter Username" name="kadi" required>
    <label for="psw"><b>Password</b></label>
    <input id="psw" type="password" placeholder="Enter Password" name="sifre" required>
    <button type="submit">Login</button>
    
  </div>

  
</form>

</body>
</html>
