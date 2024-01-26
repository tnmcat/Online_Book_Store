<?php
session_start();
ob_start();
$conn = mysqli_connect('localhost', 'root', '', 'onbookstore_db');

$book_id = (int)$_POST['book_id'];
$book_price = (float)$_POST['book_price'];
// $book_name = $_POST['book_name'];
$qty_input = (int)$_POST['qty_input'];

$item= mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM book WHERE book_id='{$book_id}'"));

if(isset($_SESSION['cart'])&&array_key_exists($book_id, $_SESSION['cart'])){
    $_SESSION['cart'][$book_id]['qty'] +=$qty_input;
} else {
    $_SESSION['cart'][$book_id] = array(
        'book_id' => $book_id,
        'book_name' => $item['book_name'],
        'book_price' => $book_price,
        'qty'=> $qty_input,
        'subtotal' => $book_price*$qty_input
    );
}

$total = 0;
foreach( $_SESSION['cart'] as $item){
    $total += $item['subtotal'];
}

$result = array(  
    'book_name' => $item['book_name'],
    'qty' => $qty_input,
    'book_id' => $book_id,
    'book_price' => $book_price,
    'subtotal' => $qty_input * $book_price,   
    'total' => $total
);
echo json_encode($result);

?>