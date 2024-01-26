<?php
session_start();
   
        $book_id = (int) $_GET['book_id'];
       
        if(!empty($book_id)){
            unset($_SESSION['cart'][$book_id]);          
        }
        else{
            unset($_SESSION['cart']);

        }
   
        header("Location: show.php");