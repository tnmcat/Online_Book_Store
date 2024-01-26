<?php 
session_start();
include("../../db/DBConnect.php");

include("../../db/database.php");
// include_once("users.php");

if (isset($_POST["btn_submit"])) {
    $username = $_POST["name"];
    $password = md5($_POST["pass"]);
    $cpassword = md5($_POST["cpass"]);
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
     $error =  '';
    // lấy thông tin tu cac form bang phuong thuc POST
    //$_POST lây gia tri the thong qua name"" - chu khong phai id"" 
    if ($username == "" || $password == "" || $cpassword == "" || $email == "" || $phone == "" || $address == "" || $gender == "") {
       
        $error =  " Ban vui long nhap day du thong tin";
    } else {
        // Kiem tra tai khoan da ton tai chua
        $sql = "select * from customer  where name= '$username' ";
        global $conn;
        $rs = mysqli_query($conn, $sql);

        if (mysqli_num_rows($rs) > 0) {
            echo "Account already exist";
        } else {
            if ($password === $cpassword) {
                $is_block = 0;
                // thuc hien viec luu tru du lieu vao db      
                $sql = "INSERT INTO customer(
             `name`, `pwd`,`email`, `phone`,`address`,`gender`, `is_block`) VALUES (
                                       
                                        '{$username}',
                                        '{$password}',
                                        '{$email}',
                                        '{$phone}',
                                        '{$address}',
                                        '{$gender}', '{$is_block}')";
                // thuc thi cau $sql vao bien conn lay tu file DBConnect.php                            
                mysqli_query($conn, $sql);

                echo " Signup Successfull";
                header("Location:../home/main.php");
            } else {
                echo "Password didn't match";
            }
        }
    }    
}

if (isset($_POST['btn-login'])) {
    $error = login();
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
                <li class='active'>Register</li>
            </ul>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
        <div class="row">

                        <!-- Sign-in -->
                        <form action="register.php" method="post">
                        <div class="col-md-3"></div>
                            <div class="col-md-6 col-sm-6 create-new-account">
                                <h4 class="checkout-subtitle">Create a new account</h4>
                            <h6>   <?php if (isset($error)){ echo $error;} ?> </h6>  
                                <p class="text title-tag-line">Create your new account.</p>
                                <form class="register-form outer-top-xs" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="name">User Name <span>*</span></label>
                                        <input type="text" name ="name" class="form-control text-input" id="name" >
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="pass">Password <span>*</span></label>
                                        <input type="password" name ="pass"class="form-control text-input" id="pass" >
                             
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="cpass">Confirm Password <span>*</span></label>
                                        <input type="password" name ="cpass" class="form-control text-input" id="cpass" >
                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="email">Email <span>*</span></label>
                                        <input type="email" name ="email" class="form-control text-input" id="email" >
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="phone">Phone Number <span>*</span></label>
                                        <input type="text" name ="phone" class="form-control text-input" id="phone" >
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="address"> Address <span>*</span></label>
                                        <input type="text" name ="address" class="form-control text-input" id="address" >
                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="info-title" for="gender">Gender <span>*</span></label>
                                        <input type="radio" class="form-control  unicase-form-control text-input" value="1"name="gender" checked>Male
                                        <input type="radio" class="form-control  unicase-form-control text-input" value="0"name="gender" > Female
                                    </div>

                                    <button type="submit" name ="btn_submit" value ="Register" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>


                            </div>

                        </form>
                    </div><!-- create a new account --></div><!-- /.row -->
    </div><!-- /.sign-in-->
</div><!-- /.body-content -->
<?php 
include("../../inc/footer.php");
?>