<?php

session_start();
session_destroy();
header("Location: ../mainPage/index.php");
?>