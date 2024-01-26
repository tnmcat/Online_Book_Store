<?php

$server = "localhost"; 
$account = "root";
$password = "";
$database = "onbookstore_db";

$conn = mysqli_connect($server, $account, $password, $database);

// if ($conn == null):
//     die("Connection fails!");
// else:
//     echo"Congratulation!!!";    
// endif;