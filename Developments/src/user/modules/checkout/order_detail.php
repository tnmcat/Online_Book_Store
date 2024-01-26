<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
include("../../inc/header.php");
$order_id = $_GET['order_id'];
$customer_infor = db_fetch_row("SELECT customer.name, customer.email, customer.address, customer.phone 
FROM customer, ordermaster 
WHERE ordermaster.cus_id = customer.id 
AND ordermaster.order_id = '{$order_id}'");

$orderDetail_infor = db_fetch_array("SELECT book.book_id, book.book_name, 
orderdetail.quantity as qty, orderdetail.book_price
FROM ordermaster, orderdetail, book 
WHERE orderdetail.book_id = book.book_id 
AND ordermaster.order_id = orderdetail.order_id 
AND ordermaster.order_id = '{$order_id}'");

$orderMaster_infor = db_fetch_row("SELECT ordermaster.order_date, ordermaster.order_id, ordermaster.shipping_name, 
ordermaster.shipping_address, ordermaster.shipping_phone, 
ordermaster.order_note, ordermaster.order_status, ordermaster.payment_method, ordermaster.last_modify_at
FROM ordermaster WHERE ordermaster.order_id = '{$order_id}'");
$total = 0;

?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="../home/main.php">Home</a></li>
                <li><a href="show_order.php">Order</a></li>
                <li class='active'>Detail</li>
            </ul>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="container">
        <form method="POST" action="send.php">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5">
                        <div class="panel-group checkout-steps">
                            <div class="panel panel-default checkout-step-03">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>1</span>Shipping Information
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <div>
                                            <ul class="nav nav-checkout-progress list-unstyled">
                                                <li>
                                                    <label class="info-title control-label">Fullname
                                                    </label> </br>
                                                    <p>
                                                        <?= $orderMaster_infor['shipping_name'] ?>
                                                    </p>
                                                </li>
                                                <li>
                                                    <label class="info-title control-label">Address</label>
                                                    </br>
                                                    <p>
                                                        <?= $orderMaster_infor['shipping_address'] ?>
                                                    </p>
                                                </li>
                                                <li>
                                                    <label class="info-title control-label">Phone
                                                        number</label>
                                                    </br>
                                                    <p>
                                                        <?= $orderMaster_infor['shipping_phone'] ?>
                                                    </p>
                                                </li>
                                                <li>
                                                    <label class="info-title control-label">Note</label>
                                                    </br>
                                                    <p>
                                                        <?= $orderMaster_infor['order_note'] ?>
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default checkout-step-04">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>2</span>Shipping Method
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        Standard Shipping
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default checkout-step-04">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>3</span>Payment Method
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <?= $orderMaster_infor['payment_method'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default checkout-step-04">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>4</span>Order Status
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <?= $orderMaster_infor['order_status'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7">
                        <div class="panel-group checkout-steps">
                            <div class="panel panel-default checkout-step-06">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>5</span>ORDER SUMMARY
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse show">
                                    <div class="panel-body"><label class="info-title control-label">Order ID: </label>
                                        <?= $orderMaster_infor['order_id'] ?>
                                    </div>
                                    <div class="panel-body"><label class="info-title control-label">Order Date: </label>
                                        <?= $orderMaster_infor['order_date'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default checkout-step-06">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">
                                        <a>
                                            <span>6</span>ORDER ITEM
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse show">

                                    <div class="panel-body">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <td><strong>Bookname</strong></td>
                                                        <td><strong>Price</strong></td>
                                                        <td><strong>Quantity</strong></td>
                                                        <td><strong>Subtotal</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (count($orderDetail_infor) == 0) {
                                                        echo "No item";
                                                    } else {
                                                        foreach ($orderDetail_infor as $item) {
                                                            $total += $item['book_price'] * $item['qty'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $item['book_name'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item['book_price'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item['qty'] ?>
                                                                </td>
                                                                <td>
                                                                    <?= $item['book_price'] * $item['qty'] ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>Total: </strong></td>
                                                        <td><strong>
                                                                <?= $total ?>$
                                                            </strong>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>Shipping Fee: </strong></td>
                                                        <td><strong>0 $</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><strong>Overal Total: </strong></td>
                                                        <td><strong>
                                                                <?= $total ?> $
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include("../../inc/footer.php");
?>