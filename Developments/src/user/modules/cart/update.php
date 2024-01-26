<?php
session_start();
ob_start();
$conn = mysqli_connect('localhost', 'root', '', 'onbookstore_db');
$book_id = (int)$_POST['book_id'];
$book_price = (int)$_POST['book_price'];
$qty_input = (int)$_POST['qty_input'];



if(isset($_SESSION['cart'])&&array_key_exists($book_id, $_SESSION['cart'])){
    $_SESSION['cart'][$book_id]['qty'] =$qty_input; 
    $_SESSION['cart'][$book_id]['subtotal'] =$qty_input*$book_price;
}

$total = 0;
foreach( $_SESSION['cart'] as $item){
    $total += $item['subtotal'];
}

$result = array(     
    'qty' => $qty_input,
    'book_id' => $book_id,  
    'subtotal' => $qty_input * $book_price,   
    'total' => $total
);
echo json_encode($result);