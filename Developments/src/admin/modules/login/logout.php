<?php
session_start();
include_once("../../db/DBConnect.php");
unset ($_SESSION['admin_login']);

header('Location:../../index.php');


