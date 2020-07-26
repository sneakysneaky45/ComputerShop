<?php
function OpenCon()
 {
	$connect = mysqli_connect('localhost', 'root', 'meinPasswort', 'webshop')or die("Connect failed: %s\n". $conn -> error);
 
 return $connect;
 }
 
function CloseCon($conn)
 {
 $connect -> close();
 } 
?>