<?php
session_start();

require_once '../../db/DBConnect.php';
$info_user = $_SESSION['user_login'];
$emailerror = "";

if (isset($_POST['btn-update'])):
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $query = "update customer set email = '{$email}', phone = '{$phone}', address = '{$address}', gender='{$gender}'  where id = '{$id}'";
    echo $query;
    $rs = mysqli_query($conn, $query);

    if (!$rs) {
        error_clear_last();
        die("Nothing to update!");
    }
    $query = "SELECT * FROM customer WHERE id = '{$id}'";
    $rs = mysqli_query($conn, $query);
    $num = mysqli_fetch_assoc($rs);
    $_SESSION['user_login'] = $num;
    header('location: show-info.php');

    mysqli_close($conn);
endif;
?>
<?php
include("../../inc/header.php");
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="../home/main.php">Home</a></li>
                <li class='active'>My Profile</li>
            </ul>
        </div>
    </div>
</div>
<body class="cnt-home">
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <div class="col-md-3"></div>
                    <form action="show-info.php" method="post">
                        <div class="col-md-6 col-sm-12 create-new-account">
                            <h3 class="checkout-subtitle">Customer Information</h3>
                            <form class="register-form outer-top-xs" role="form">
                                <div class=" form-group">
                                    <input type="hidden" value=" <?php echo $info_user['id'] ?>" name="id">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="name">Name <span></span></label>
                                    <input type="text" name="name" class="form-control unicase-form-control text-input"
                                        id="id" value=" <?php echo $info_user['name'] ?>" readonly="">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Email <span></span></label>
                                    <input type="email" name="email"
                                        class="form-control unicase-form-control text-input" id="email"
                                        value="<?php echo $info_user['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone Number <span></span></label>
                                    <input type="text" name="phone" class="form-control unicase-form-control text-input"
                                        id="phone" value=" <?php echo $info_user['phone'] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="address"> Address <span></span></label>
                                    <input type="text" name="address"
                                        class="form-control unicase-form-control text-input" id="address"
                                        value=" <?php echo $info_user['address'] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="gender">Gender <span></span></label>
                                    <input <?php if ($info_user['gender'] == 1)
                                        echo 'checked'; ?> type="radio"
                                        class="form-control unicase-form-control text-input" value="1"
                                        name="gender">Male
                                    <input <?php if ($info_user['gender'] == 0)
                                        echo 'checked'; ?> type="radio"
                                        class="form-control unicase-form-control text-input" value="0" name="gender">
                                    Female
                                </div>
                                <div >
                                    <button type="submit" name="btn-update" value="Update"
                                        class="btn-upper btn btn-primary checkout-page-button">Edit</button>
                                    <!-- <a href="change-pass.php"
                                        class="btn-upper btn btn-primary checkout-page-button">Change password</a> -->
                                </div>
                        </div>
                    </form>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("../../inc/footer.php");
    ?>