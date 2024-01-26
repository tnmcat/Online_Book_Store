<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
$order_id = (int) $_POST['order_id'];

if (isset($_POST['btnUpdate'])) {
  $last_modify_at = date("Y-m-d H:i:s");
  $orderStatus = $_POST['orderStatus'];

  if ($orderStatus == "Pending" || $orderStatus == "Cancel") {
    $last_modify_at = date("Y-m-d H:i:s");
    $orderStatus = $_POST['orderStatus'];
    $query = "UPDATE `ordermaster` SET `order_status` = '{$orderStatus}', `last_modify_at` = '{$last_modify_at}'  
      WHERE `ordermaster`.`order_id` = '{$order_id}'";
    $rs = mysqli_query($conn, $query);
    if (!$rs) {
      error_clear_last();
      echo 'nothing to update';
    }
    header("Location:detail.php?order_id=$order_id&successUpdate");
  }


  $list_update = db_fetch_array("SELECT * FROM book, orderdetail WHERE book.book_id = orderdetail.book_id 
    AND orderdetail.order_id = $order_id");

  if ($orderStatus == "Completed") {
    foreach ($list_update as $row) {
      $book_id = $row['book_id'];
      $quantity = $row['quantity'];
      $inventory = $row['inventory'];

      if ($inventory < $quantity) {
        header("Location:detail.php?order_id=$order_id&errorStock");

             
      } else {
        
        $update_query = "UPDATE book SET book.inventory = book.inventory-$quantity WHERE book.book_id = $book_id";
        $result = mysqli_query($conn, $update_query);
        if (!$result) {
          error_clear_last();
          echo 'nothing to update';
        }
       
        $query = "UPDATE `ordermaster` SET `order_status` = '{$orderStatus}', `last_modify_at` = '{$last_modify_at}'  
          WHERE `ordermaster`.`order_id` = '{$order_id}'";
        $rs = mysqli_query($conn, $query);
        if (!$result) {
          error_clear_last();
          echo 'nothing to update';
          header("Location:detail.php?order_id=$order_id&errorUpdate");
        }  
        header("Location:detail.php?order_id=$order_id&successUpdate");  
      }
      
    }
     

  }
  if ($orderStatus == "Refund") {
    foreach ($list_update as $row) {
      $book_id = $row['book_id'];
      $quantity = $row['quantity'];
      $inventory = $row['inventory'];
     
        $update_query = "UPDATE book SET book.inventory = book.inventory+$quantity WHERE book.book_id = $book_id";
        $result = mysqli_query($conn, $update_query);
        if (!$result) {
          error_clear_last();
          echo 'nothing to update';
        }

        $query = "UPDATE `ordermaster` SET `order_status` = '{$orderStatus}', `last_modify_at` = '{$last_modify_at}'  
          WHERE `ordermaster`.`order_id` = '{$order_id}'";
        $rs = mysqli_query($conn, $query);
        if (!$result) {
          error_clear_last();
          echo 'nothing to update';
          header("Location:detail.php?order_id=$order_id&errorUpdate");
        }              
    }
    header("Location:detail.php?order_id=$order_id&successUpdate");   
  }

}
?>