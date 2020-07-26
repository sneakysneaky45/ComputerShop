<?php
session_start();

$con = mysqli_connect('localhost', 'root', 'meinPasswort', 'webshop'); 

mysqli_select_db($con, 'users');

$email = $_POST['inputEmail'];
$prename = $_POST['inputPrename'];
$name = $_POST['inputName'];
$password = $_POST['inputPassword'];
$checkpassword = $_POST['inputCheckPassword'];
$username = $_POST['inputUsername'];

$s = " select * from users where E_Mail = '$email' ";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
	echo"Es existiert bereits ein Account mit dieser Email-Adresse";
}
else{
	$reg= " insert into users(Vorname,Nachname,E_Mail,Username,Passwort) values('$prename','$name','$email','$username','$password')";
	mysqli_query($con,$reg);
	header("Location: ../login/login.php");
}
?>