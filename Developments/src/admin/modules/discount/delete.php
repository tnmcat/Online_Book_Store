<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");

#4. Get Item Code from Read
if (!isset($_GET['code'])):
    header("location:read.php");
endif;
$ID = $_GET['code'];

#5. Excecute query
$query = "delete from discount where discount_id = '{$ID}'";
    $rs = mysqli_query($conn, $query);
    if (!$rs):
        
        echo 'Nothing to Update!';
    endif;
    header("location:read.php");
#6. Close Connection
mysqli_close($conn);
