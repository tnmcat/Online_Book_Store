<?php
session_start();
include_once("../../db/DBConnect.php");
unset ($_SESSION['user_login']);

header('Location:../home/main.php');


