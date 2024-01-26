<?php
session_start();
include_once("../../db/DBConnect.php");
include("../../inc/header.php");
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
}
?>
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="container-fluid">
                    <div class="container text-center">
                        <i class="fa fa-check" style="font-size:68px; color:green"></i>
                        <h1>Thank you</h1>
                        <p class="lead w-lg-50 mx-auto">Your order has been placed successfully.</p>
                        <p class="w-lg-50 mx-auto">Your order number is </p>
                        <span>
                            <?= $order_id ?>
                        </span>
                        <p>We will immediatelly process your and it will be delivered in 3 - 5 business days.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../../inc/footer.php");
?>