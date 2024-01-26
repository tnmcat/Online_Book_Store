<?php 
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");

if (!isset($_GET['code'])):
    header("location:read.php");
endif;
$ID = $_GET['code'];
$query = "select * from discount where discount_id = '{$ID}'";
$rs = mysqli_query($conn, $query);
$fields = mysqli_fetch_array($rs);

if (isset($_POST['btnUpdate'])):
    $ID = $_POST['txtId'];
    $Start = $_POST['txtStart'];
    $End = $_POST['txtEnd'];   
    $query = "update discount set discount_start = '{$Start}', discount_end = '{$End}' where discount_id = '{$ID}'";
    $rs = mysqli_query($conn, $query);
    if (!$rs):
        error_clear_last();
        echo 'Nothing to Update!';
    endif;
    header("location:read.php");
endif;
mysqli_close($conn);
?>
<?php 
include("../../inc/header.php");
?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Update Discount</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">Discount</li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
      <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Update Discount</h5>       
              <form class="row g-3" method="POST">
                <div class="col-12">
                  <label class="form-label">ID: </label>
                  <input class="form-control" name="txtId" value="<?= $fields[0] ?>" readonly>
                </div>
                <div class="col-12">
                  <label class="form-label">Date Start: </label>
                  <input class="form-control" type="text" name="txtStart" id="start_discount" value="<?= $fields[4] ?>">
                </div>
                <div class="col-12">
                  <label class="form-label">Date End:</label>
                  <input type="text" name="txtEnd" id="end_discount" value="<?= $fields[5] ?>" class="form-control">
                </div>                
                <div class="text-center">
                  <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update" 
                  onclick="return confirm('Are you sure to update Item <?= $fields[0] ?>')">
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