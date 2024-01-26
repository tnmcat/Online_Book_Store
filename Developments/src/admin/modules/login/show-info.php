<?php
session_start();
require_once '../../db/DBConnect.php';
require_once '../../db/database.php';
$info_admin =$_SESSION['admin_login'];
$emailerror = "";
$query = "SELECT * FROM webmaster where admin_id =1";
$rs = mysqli_query($conn, $query);
$num = mysqli_fetch_assoc($rs);
$_SESSION['admin_login'] = $num;
?>
<?php
include("../../inc/header.php");
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>
  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <i class="bi bi-person-fill" style="font-size:120px"></i>
            <h2>admin</h2>
            <h3></h3>
          </div>
        </div>
      </div>
      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">         
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab"
                  data-bs-target="#profile-overview">Overview</button>
              </li>
            </ul>
            <div class="tab-content pt-2">
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Webmaster in OnBookStore from April 1, 2023</p>
                <h5 class="card-title">Profile Details</h5>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">ID</div>
                  <div class="col-lg-9 col-md-8">
                    <?php echo $num['admin_id'] ?>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">UserName</div>
                  <div class="col-lg-9 col-md-8">
                    <?php echo $num['admin_name'] ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">
                    <?php echo $num['admin_email'] ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
include("../../inc/footer.php");
?>