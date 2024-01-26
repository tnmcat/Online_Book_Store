<?php
//ket noi database
$conn = mysqli_connect('localhost', 'root', '', 'onbookstore_db');
if(!$conn){
    // echo "ket noi khong thanh cong".mysqli_connect_error();
    die();
}