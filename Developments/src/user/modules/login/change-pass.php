<?php
session_start();
include '../../db/DBConnect.php';
if (isset($_SESSION['user_login'])) {
    if (isset($_POST["btn_change"])) {
        if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['c_np'])) {
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            $op = validate($_POST['op']);
            $np = validate($_POST['np']);
            $c_np = validate($_POST['c_np']);

            if (empty($op)) {
                header("Location: change-pass.php?error=Old Password is required");
                exit();
            } else if (empty($np)) {
                header("Location: change-pass.php?error=New Password is required");
                exit();
            } else if ($np !== $c_np) {
                header("Location: change-pass.php?error=The confirmation password  does not match");
                exit();
            } else {
                // hashing the password
                $op = md5($op);
                $np = md5($np);
                $id = $_SESSION['user_login']['id'];

                $squery = "SELECT pwd
                FROM customer WHERE 
                id='$id' AND pwd='$op'";
                $rs = mysqli_query($conn, $squery);
                if (mysqli_num_rows($rs) === 1) {

                    $squery = "UPDATE customer
        	          SET pwd='$np'
        	          WHERE id='$id'";
                    mysqli_query($conn, $squery);
                    header("Location: change-pass.php?success=Your password has been changed successfully");
                    exit();

                } else {
                    header("Location: change-pass.php?error=Incorrect password");
                    exit();
                }
            }
        } else {
            header("Location: change-pass.php");
            exit();
        }
    }
}
?>
<?php
include("../../inc/header.php");
?>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="../home/main.php">Home</a></li>
                <li class='active'>Change Password</li>
            </ul>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-6 sign-in">
                    <div id="wp-form-login" class=" sign-in">
                        <h3 class="title_form_login">Change Password</h3>
                        <form action="change-pass.php" method="post">
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="error">
                                    <?php echo $_GET['error']; ?>
                                </p>
                            <?php } ?>
                            <?php if (isset($_GET['success'])) { ?>
                                <p class="success">
                                    <?php echo $_GET['success']; ?>
                                </p>
                            <?php } ?>
                            <div class="form-group">
                                <label class="info-title" for="pass">Old Password <span>*</span></label>
                                <input type="password" name="op" id="op" value="" placeholder="Old  Password"
                                    class="form-control text-input" />
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="pass"> New Password <span>*</span></label>
                                <input type="password" name="np" id="np" value="" placeholder="New password"
                                    class="form-control text-input">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="pass"> Confirm Password <span>*</span></label>
                                <input type="password" name="c_np" id="c_np" value="" placeholder="Confirm password"
                                    class="form-control text-input">
                            </div>
                            <input type="submit" name="btn_change"
                                class="btn-upper btn btn-primary checkout-page-button" value="CHANGE">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../../inc/footer.php");
?>