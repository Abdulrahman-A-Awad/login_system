<?php

session_start();
unset($_SESSION['user']);
header('location:login.php');
include_once "middlewares/auth.php";
