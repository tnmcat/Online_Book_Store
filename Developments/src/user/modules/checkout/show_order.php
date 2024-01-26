<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");

if (!isset($_SESSION['user_login']['id'])) {
    header("Location: ../login/login.php");

} else {
    $user_id = (int) $_SESSION['user_login']['id'];
}
$list_order = db_fetch_array("SELECT SUM(quantity*book_price) as total, ordermaster.order_id, 
ordermaster.payment_method, ordermaster.order_date, ordermaster.order_status 
FROM orderdetail, ordermaster
WHERE orderdetail.order_id = ordermaster.order_id AND ordermaster.cus_id = '{$user_id}'
GROUP BY orderdetail.order_id");
// var_dump($list_order);
?>

<?php
include("../../inc/header.php");
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="../home/main.php">Home</a></li>
                <li class='active'>Order</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="col-md-12 col-sm-12">
                <table class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Date of purchase</th>
                            <th>Payment Method</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($list_order) == 0) {
                            echo "no data";
                        } else {
                            foreach ($list_order as $row) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['order_id'] ?>
                                    </td>
                                    <td>
                                        <?= $row['order_date'] ?>
                                    </td>
                                    <td>
                                        <?= $row['payment_method'] ?>
                                    </td>
                                    <td>
                                        <?= $row['total'] ?>
                                    </td>
                                    <td>
                                        <?= $row['order_status'] ?>
                                    </td>
                                    <td><a href="order_detail.php?order_id=<?= $row['order_id'] ?>">Details</a></td>

                                </tr>
                                <?php

                            }
                        }
                        ?>


                    </tbody>
                </table>



            </div>

        </div>
    </div>
</div>


<?php
include("../../inc/footer.php");
?>