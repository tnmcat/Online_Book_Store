<?php
#1. Database information
$server = "localhost"; //port default 3306, 3308
$account = "root";
$password = "";
$database = "Feedback";

#2. Database connection string
$conn = mysqli_connect($server, $account, $password, $database);

#3. Test connection 
// if (!$conn):
//     die("Error: Connection fails!");
// else:
//     echo 'Congratulation!';
// endif;