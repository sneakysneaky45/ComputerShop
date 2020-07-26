<?php
session_start();

include 'db_connection.php';

$con = OpenCon(); 

mysqli_select_db($con, 'users');

$email = mysqli_real_escape_string($con,$_POST['inputEmail']);
$password = mysqli_real_escape_string($con, $_POST['inputPassword']);


$s = " select * from users where E_Mail = '$email'";

$result = mysqli_query($con, $s);

$verifyExistence = mysqli_num_rows($result);

$sessionInfo = $result->fetch_array(MYSQLI_ASSOC);
$myHashPassword = $sessionInfo['Passwort'];

	
if($verifyExistence < 1){
	header("Location: ../login/login.php");
}

else{
	$hashedPassword = password_verify($password, $myHashPassword);
	if($hashedPassword == false){
		header("Location: ../login/login.php");
	}
	elseif($hashedPassword == true){
	$_SESSION['username'] = $sessionInfo['Username'];
	$_SESSION['email'] = $sessionInfo['E_Mail'];
	$_SESSION['prename'] = $sessionInfo['Vorname'];
	$_SESSION['name'] = $sessionInfo['Nachname'];
	$_SESSION['rolle'] = $sessionInfo['Rolle'];
	header("Location: ../mainPage/index.php");
	
}
else{
	header("Location: ../login/login.php");
}
}
 CloseCon($con);
?>