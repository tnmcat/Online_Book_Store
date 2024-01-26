<?php 
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");

if (isset($_POST['btnAdd'])):
        $name = $_POST['txtName'];
        $Description = $_POST['txtDescription'];
        $Percentage = $_POST['txtPercentage'];
        $Strat = $_POST['txtStart'];
        $End = $_POST['txtEnd'];
    
        $query = "insert into discount (discount_name, discount_des, discount_per, discount_start, discount_end) values ('{$name}', '{$Description}', '{$Percentage}', '{$Strat}', '{$End}')";
        $rs = mysqli_query($conn, $query);
        if (!$rs):
            echo 'Nothing to insert!';
        endif;
    header("location:read.php");
endif;
?>
<?php 
include("../../inc/header.php");
?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Add Discount</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <h5 class="card-title">Add Discount</h5>            
              <form class="row g-3" method="POST" >
                <div class="col-12">
                  <label class="form-label">Name</label>
                  <input class="form-control" name="txtName">
                </div>
                <div class="col-12">
                  <label class="form-label">Description</label>
                  <input class="form-control" name="txtDescription">
                </div>
                <div class="col-12">
                  <label class="form-label">Percentage</label>
                  <input name="txtPercentage" class="form-control">
                </div>
                <div class="col-12">
                  <label class="form-label">Date Start</label>
                  <input type="text" class="form-control" name="txtStart" id="start_discount">
                </div>
                <div class="col-12">
                  <label class="form-label">Date End</label>
                  <input type="text" class="form-control"  name="txtEnd" id="end_discount">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btnAdd">Submit</button>
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