<?php 
session_start();
   include_once '../../db/DBConnect.php';
   include("../../inc/header.php");
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Feedback</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
      <li class="breadcrumb-item">Customer</li>
      <li class="breadcrumb-item active">Feedback</li>
    </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
      <div>          
            <div class="row">
                <div class="col-xs-12">
                    <input class="form-control" id="txtSearch" placeholder="Search">
                    <div id="txtDisplay"></div>                   
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