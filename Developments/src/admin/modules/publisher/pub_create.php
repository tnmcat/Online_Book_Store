
<?php
session_start();
include_once("../../db/DBConnect.php");

$phoneErr = $urlErr = $emailErr = "";
$Phone = $LinkWeb = $Email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["txtPhone"])) {
        $phoneErr = "Phone number is required";
      } else {
        $Phone = test_input($_POST["txtPhone"]);
        if (!preg_match("/^[0-9]{8,12}$/", $Phone)) {
          $phoneErr = "Invalid phone number";
        }
    }
    // Website
    if (empty($_POST["txtLinkWeb"])) {
        $urlErr = "URL is required";
    } elseif(!filter_var($_POST["txtLinkWeb"], FILTER_VALIDATE_URL)) {
        $urlErr = "Invalid Url";
    }else {
        $LinkWeb = test_input($_POST["txtLinkWeb"]);
    }
    // Email
    if (empty($_POST["txtEmail"])) {
        $emailErr = "Email is required";
    } elseif(!filter_var($_POST["txtEmail"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid Email";
    }else {
        $Email = test_input($_POST["txtEmail"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['btnAdd'])):
    $Name = $_POST['txtName'];
    $LinkWeb = $_POST['txtLinkWeb'];
    $Phone = $_POST['txtPhone'];
    $Email = $_POST['txtEmail'];
    $Address = $_POST['txtAddress'];

    // process image value
    $folder = "../../public/assets/img/publisher/";
    $fileName = $_FILES['txtLogo']['name'];
    $fileTmp = $_FILES['txtLogo']['tmp_name'];
    $logo = $folder . $fileName;
    // file upload
    move_uploaded_file($fileTmp, $logo);

if (empty($phoneErr) && empty($urlErr) && empty($emailErr)) :
  $query = "insert into publisher (publisher_name, publisher_logo, publisher_web, publisher_phone, publisher_email, publisher_address) values ('{$Name}', '{$logo}', '{$LinkWeb}', '{$Phone}', '{$Email}', '{$Address}')";
  $rs = mysqli_query($conn, $query);
    if (!$rs):
        echo 'Nothing to insert!';
    endif;
    header("Location:pub_read.php");
endif;
endif;

mysqli_close($conn);
?>
<?php
include("../../inc/header.php");
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Add Publisher</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
      <li class="breadcrumb-item">Book</li>
      <li class="breadcrumb-item active">Publisher</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">
  <div class="col-lg-3"></div>
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Add Publisher</h5>
          <!-- Horizontal Form -->
          <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-12">
              <label class="form-label">Logo</label>
              <input class="form-control" type="file" name="txtLogo">
            </div>
            <div class="col-12">
              <label class="form-label">Name</label>
              <input type="text" class="form-control"  name="txtName">
            </div>
            <div class="col-12">
              <label class="form-label">Website</label>
              <input class="form-control" name="txtLinkWeb">
              <span class="error" style="color:red"> <?php echo $urlErr; ?></span>
            </div>
            <div class="col-12">
              <label class="form-label">Phone</label>
              <input type="text" name="txtPhone" class="form-control">
              <span class="error" style="color:red"> <?php echo $phoneErr; ?></span>
            </div>
            <div class="col-12">
              <label class="form-label">Email</label>
              <input type="text" class="form-control" name="txtEmail">
              <span class="error" style="color:red"> <?php echo $emailErr; ?></span>
            </div>
            <div class="col-12">
              <label class="form-label">Address</label>
              <input type="text" class="form-control"  name="txtAddress">
            </div>
            <div class="text-center">
              <input type="submit" class="btn btn-primary" name="btnAdd" value="Submit">
              <button type="reset" class="btn btn-secondary" name="btnClear">Reset</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>
</main>
<?php
include("../../inc/footer.php");

?>