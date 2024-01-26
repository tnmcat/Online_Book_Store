<?php
session_start();
require '../../db/DBConnect.php';
require '../../db/database.php';

if (isset($_POST['btn-login'])) {
    $username = $_POST['admin_name'];
    $password = $_POST['admin_pass'];
//    $error = [
//        'admin_name' => "",
//        'admin_pass' => "",
//        'common' => ''
//    ];
//    // check username format
//  if (!preg_match('/^[A-Za-z0-9_\.]{3,32}$/', $username)) {
//    $error['admin_name'] = "Username incorrect";
//  }
//  // check password format
//  if (!preg_match('/^[A-Za-z0-9_\.!@#$%^&*()]{3,32}$/', $password)) {
//    $error['admin_pass'] = "Password incorrect";
//  }
  // process login
//  $md5Password = md5($password);
  $sql = "select * from webmaster where admin_name ='$username' and admin_pwd = '$password' ";

  global $conn;
  $rs = mysqli_query($conn, $sql);
  if (mysqli_num_rows($rs) > 0) {
    $firstUserInfo = mysqli_fetch_array($rs);
    $_SESSION['is_login'] = true;
    $_SESSION['admin_login'] = $firstUserInfo[0];
    header('Location:../home/main.php');
  } else {
    $error['common'] = "Login fail!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Dashboard - OnBookStore</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <!-- Favicons -->
        <link href="../../public/assets/img/favicon.png" rel="icon">
        <link href="../../public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="../../public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../../public/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="../../public/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="../../public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../../public/assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="../../public/assets/css/style.css" rel="stylesheet">

        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <!-- js cua Quan -->
        <script src="../public/assets/js/scriptLiveSearch.js"></script> 

        <!-- fonts discount_date -->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    </head>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>
                  <form class="row g-3 needs-validation" method="POST">
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="admin_name" class="form-control" id="yourUsername" required>
                        <?php
                           if (!empty($error['admin_name'])) {
                               ?>
                        <p class="error"><?php echo $error['admin_name'] ?></p>
                        <?php
                    }
                    ?></div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="admin_pass" class="form-control" id="yourPassword" required>
                      <?php
                           if (!empty($error['admin_name'])) {
                               ?>
                        <p class="error"><?php echo $error['admin_name'] ?></p>
                        <?php
                    }
                    ?>
                    </div>                      
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="btn-login">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
<?php
require '../../inc/footer.php';
?>