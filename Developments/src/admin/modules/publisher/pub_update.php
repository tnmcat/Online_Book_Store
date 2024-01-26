<?php 
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");


//thiếu publisher name ?????

//lỗi nhập số điện thoại bị mất sô 0 ?????




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

if (!isset($_GET['code'])):
    header("location:pub_read.php");
endif;
$ID = $_GET['code'];

#5. Execute query (for data reading by Item code)
$query = "select * from publisher where publisher_id = '{$ID}'";
$rs = mysqli_query($conn, $query);
$fields = mysqli_fetch_array($rs);

if (isset($_POST['btnUpdate'])):
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
    //2. file upload
    move_uploaded_file($fileTmp, $logo);

    if (empty($phoneErr) && empty($urlErr) && empty($emailErr)) :
        $query = "update publisher set publisher_name = '{$Name}', publisher_logo = '{$logo}', publisher_web = '{$LinkWeb}', publisher_phone = '{$Phone}', publisher_email = '{$Email}', publisher_address = '{$Address}' where publisher_id = '{$ID}'";
        $rs = mysqli_query($conn, $query);
        if (!$rs):
            error_clear_last();
            echo 'Nothing to Update!';
        endif;
        header("location:pub_read.php");
    endif;
    endif;

#7. Close Connection
mysqli_close($conn);
?>
<?php
include("../../inc/header.php");
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Update Publisher</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <h5 class="card-title">Update Publisher</h5>

              <!-- Horizontal Form -->
              <form class="row g-3" method="POST" enctype="multipart/form-data">
                <div class="col-12">
                  <label class="form-label">ID</label>
                  <input name="txtId" class="form-control" value="<?= $fields[0] ?>" readonly>
                </div>
                <div class="col-12">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control"  name="txtName" value="<?= $fields[1] ?>">
                </div>
                <div class="col-12">
                  <label class="form-label">Logo</label>
                  <input class="form-control" type="file" name="txtLogo" value="<?= $fields[2] ?>">
                </div>
                <div class="col-12">
                  <label class="form-label">Website</label>
                  <input class="form-control" name="txtLinkWeb" value="<?= $fields[3] ?>">
                  <span class="error" style="color:red"> <?php echo $urlErr; ?></span>
                </div>
                <div class="col-12">
                  <label class="form-label">Phone</label>
                  <input type="text" name="txtPhone" value="<?= $fields[4] ?>" class="form-control">
                  <span class="error" style="color:red"> <?php echo $phoneErr; ?></span>
                </div>
                <div class="col-12">
                  <label class="form-label">Email</label>
                  <input type="text" class="form-control" name="txtEmail" value="<?= $fields[5] ?>">
                  <span class="error" style="color:red"> <?php echo $emailErr; ?></span>
                </div>
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <input type="text" class="form-control"  name="txtAddress" value="<?= $fields[6] ?>">
                </div>
                <div class="text-center">
                  <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update" onclick="return confirm('Are you sure to update publisher <?= $fields[0] ?>')">
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php 
include("../../inc/footer.php");
?>