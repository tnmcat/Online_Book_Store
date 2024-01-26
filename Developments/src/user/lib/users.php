<?php


function is_login() {
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}

//return username of login
function user_login() {
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return FALSE;
}

function info_user() {
//    global $list_users;
    if (isset($_SESSION['is_login']) && $_SESSION['is_login']) {

        return $_SESSION['user_login'];
    }
    return FALSE;
}

function login() {
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
        $pattern = '/^[A-Za-z0-9_\.]{6,32}$/';
        if (!preg_match($pattern, $_POST['name'])) {
            $error['name'] = " username  incorrect ";
            $success = false;
        } else {
            $username = $_POST['name'];
        }             // replace username to name
    }
    // Check password
    if (empty($_POST['pass'])) {
        $error['pass'] = " password cannot be blank ";
        $success = false;
    } else {
        $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
        if (!preg_match($pattern, md5($_POST['pass']))) {
            $error['pass'] = " password  incorrect ";
            $success = false;
        }
    }

    //Conclusion
    if ($success) {
        $password = md5($_POST['pass']);
        $sql = "select * from customer where name ='$username'
                 and pwd ='$password' ";
        global $conn;
        $rs = mysqli_query($conn, $sql);

        if ($rs->num_rows > 0) {

            $num = mysqli_fetch_assoc($rs);
// var_dump($num);die();

            $_SESSION['is_login'] = true;
            $_SESSION['user_login'] = $num;

            $user_login = $_SESSION['num'];
            header('Location:register.php');
        } else {
            $error['common'] = "Login fail!";
        }
    }

    return $error;
}

function register() {

    //isset de kiem tra button co name la btn_submit da duoc click hay chua
//    $id = $_POST["id"];
    $username = $_POST["name"];
    $password = md5($_POST["pass"]);
    $cpassword = md5($_POST["cpass"]);
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $gender = $_POST["gender"];
    // lấy thông tin tu cac form bang phuong thuc POST
    //$_POST lây gia tri the thong qua name"" - chu khong phai id"" 
    if ($username == "" || $password == "" || $cpassword == "" || $email == "" || $phone == "" || $address == "" || $gender == "") {
        echo " Ban vui long nhap day du thong tin";
    } else {
        // Kiem tra tai khoan da ton tai chua
        $sql = "select * from customer  where name= '$username' ";
        global $conn;
        $rs = mysqli_query($conn, $sql);

        if (mysqli_num_rows($rs) > 0) {
            echo "Account already exist";
        } else {
            if ($password === $cpassword) {
                // thuc hien viec luu tru du lieu vao db      
                $sql = "INSERT INTO customer(
             name, pwd,email, phone,address,gender) VALUES (
                                       
                                        '{$username}',
                                        '{$password}',
                                        '{$email}',
                                        '{$phone}',
                                        '{$address}',
                                        '{$gender}')";
                // thuc thi cau $sql vao bien conn lay tu file DBConnect.php                            
                mysqli_query($conn, $sql);

                echo " Signup Successfull";
            } else {
                echo "Password didn't match";
            }
        }
    }
}

function logout( ){
    unset ($_SESSION['is_login']);


unset ($_SESSION['user_login']);

header('Location:index.php');
}

