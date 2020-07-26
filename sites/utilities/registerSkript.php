<?php
session_start();

include 'db_connection.php';

$con = OpenCon();

mysqli_select_db($con, 'users');

 $email = mysqli_real_escape_string($con, $_POST['inputEmail']);
 $prename = mysqli_real_escape_string($con, $_POST['inputPrename']);
 $name = mysqli_real_escape_string($con, $_POST['inputName']);
 $username = mysqli_real_escape_string($con, $_POST['inputUsername']);
 $password = mysqli_real_escape_string($con, $_POST['inputPassword']);
 $passwordCheck = mysqli_real_escape_string($con, $_POST['inputCheckPassword']);
 $hashPassword = password_hash($password,PASSWORD_DEFAULT);
if ($passwordCheck == $password){


$s = " select * from users where E_Mail = '$email' ";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	header("Location: ../register/register.php");
}
else{
	$reg= " insert into users(Vorname,Nachname,E_Mail,Username,Passwort) values('$prename','$name','$email','$username','$hashPassword')";
	mysqli_query($con,$reg);
	header("Location: ../login/login.php");
}
}
else{
	header("Location: ../register/register.php");	
}	
CloseCon($con);
?>