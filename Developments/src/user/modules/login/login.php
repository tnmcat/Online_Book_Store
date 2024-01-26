<?php
session_start();
include("../../db/DBConnect.php");
include("../../db/database.php");
if (isset($_POST['btn-login'])) {
    $username = $_POST['name'];
    $password = $_POST['pass'];
    $error = [
        'name' => "",
        'pass' => "",
        'common' => ''
    ];
    $success = true;
    if (empty(($_POST['name']))) {
        $error['name'] = " username cannot be blank ";
        $success = false;
    } else {
        $pattern = '/^[A-Za-z0-9_\.]{3,32}$/';
        if (!preg_match($pattern, $_POST['name'])) {
            $error['name'] = " username  incorrect ";
            $success = false;
        } else {
            $username = $_POST['name'];
        }
    }
    // Check password
    if (empty($_POST['pass'])) {
        $error['pass'] = " password cannot be blank ";
        $success = false;
    } else {
        $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{1,32}$/';
        if (!preg_match($pattern, $_POST['pass'])) {
            $error['pass'] = " password  incorrect ";
            $success = false;
        }
    }
    //Conclusion
    if ($success) {
        $password = ($_POST['pass']);
        $md5password = md5($password);
        $sql = "select * from customer where name ='$username'
                 and pwd = '$md5password' ";
        global $conn;
        $rs = mysqli_query($conn, $sql);

        if (mysqli_num_rows($rs) > 0) {
            $num = mysqli_fetch_assoc($rs);
            $_SESSION['is_login'] = true;
            $_SESSION['user_login'] = $num;
            $user_login = $_SESSION['num'];
            header('Location:../home/main.php');
        } else {
            $error['common'] = "Login fail!";
        }
    }
    return $error;
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
                <li class='active'>Login</li>
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
                        <h1 class="title_form_login">Login</h1>
                        <form id="form-login" action="" method="POST" class="register-form outer-top-xs" role="form">
                            <div class="form-group">
                                <label class="info-title" for="name">Username <span>*</span></label>
                                <input type="text" name="name" id="name" value="" placeholder="Username"
                                    class="form-control text-input" />
                                <?php
                                if (!empty($error['name'])) {
                                    ?>
                                    <p class="error">
                                        <?php echo $error['name'] ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="pass">Password <span>*</span></label>
                                <input type="password" name="pass" id="pass" value="" placeholder="Password"
                                    class="form-control text-input" />
                                <?php
                                if (!empty($error['pass'])) {
                                    ?>
                                    <p class="error">
                                        <?php echo $error['pass'] ?>
                                    </p>
                                    <?php
                                }
                                ?>
                            </div>
                            <input type="submit" id="btn-login" name="btn-login" value="Login"
                                class="btn-upper btn btn-primary checkout-page-button">
                            <?php
                            if (!empty($error['common'])) {
                                ?>
                                <p class="error">
                                    <?php echo $error['common'] ?>
                                </p>
                                <?php
                            }
                            ?>
                        </form>
                        <div>Don't have an account yet? <a href="register.php">Register</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("../../inc/footer.php");
?>