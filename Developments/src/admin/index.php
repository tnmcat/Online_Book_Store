<?php
    if(!isset($_SESSION['admin_login'])){
        header("location:modules/login/login.php");
    }
    else{
        header("location:modules/home/main.php");
    }
   
?>