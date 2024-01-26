<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'onbookstore_db');
$current_day = date("Y-m-d");
$previous_day = date("Y-m-d",strtotime("-1 days"));
$this_month = date("Y-m");
$previous_month = date("Y-m",strtotime("-1 months"));
$this_year = date("Y");
$previous_year = date("Y",strtotime("-1 years"));

if(isset($_POST['filter'])&&isset($_POST['scope'])){
    $filter = $_POST['filter'];
    if($_POST['scope']=="sale"){
        switch($filter){
            case "today":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$current_day%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$previous_day%'"));  
                break;
            case "this_month":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$this_month%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$previous_month%'"));
                break;
            case "this_year":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$this_year%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(order_id) AS report FROM ordermaster WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_date LIKE '$previous_year%'"));
                break;
            default:
                echo "Something went wrong !";
    
        }
    }
    else if($_POST['scope']=="revenue"){
        switch($filter){
            case "today":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$current_day%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$previous_day%'"));  
                break;
            case "this_month":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$this_month%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$previous_month%'"));
                break;
            case "this_year":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$this_year%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(orderdetail.book_price*orderdetail.quantity) AS report FROM ordermaster, orderdetail 
                WHERE ordermaster.order_status LIKE'Completed' AND ordermaster.order_id = orderdetail.order_id AND ordermaster.order_date LIKE '$previous_year%'"));
                break;
            default:
                echo "Something went wrong !";
    
        }

    }
    else if($_POST['scope']=="customer"){
        switch($filter){
            case "today":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$current_day%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$previous_day%'"));  
                break;
            case "this_month":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$this_month%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$previous_month%'"));
                break;
            case "this_year":
                $current = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$this_year%'"));
                $previous = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(distinct ordermaster.cus_id) AS report FROM ordermaster WHERE ordermaster.order_date LIKE '$previous_year%'"));
                break;
            default:
                echo "Something went wrong !";    
        }
    }

    $previous['report']==0?$percent=100: $percent=round(($current['report']/$previous['report']-1)*100,2);   

    $result =  array(
        'total' =>$current['report'],
        'percent'=> $percent,
        'status' => ($percent<0)?'decrease':'increase',        
    );
    echo json_encode($result);

 
}




