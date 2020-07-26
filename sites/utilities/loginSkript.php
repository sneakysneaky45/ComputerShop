<?php
session_start();

$con = mysqli_connect('localhost', 'root', 'meinPasswort', 'webshop'); 

mysqli_select_db($con, 'users');

$email = $_POST['inputEmail'];
$password = $_POST['inputPassword'];


$s = " select * from users where E_Mail = '$email' && Passwort = '$password'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	header('Location: ../mainPage/index.php');
		$_SESSION['username'] = $result['Username'];
		$_SESSION['email'] = $result['E_Mail'];
		$_SESSION['prename'] = $result['Vorname'];
		$_SESSION['username'] = $reset['Nachname'];
		$_SESSION['rolle'] = $email;
}
else{
	header('Location: ../login/login.php');
}
?>