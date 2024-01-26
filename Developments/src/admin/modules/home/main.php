<?php
session_start();
include("../../inc/header.php");
include_once("../../db/DBConnect.php");
?>
<main>
    <div class="container">
      <image src=""></image>
      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h3>HI, ADMIN</h3>
        <h2>Welcome Back</h2>
        <a class="btn" href="../dashboard/main.php">Let's work</a>
        <img src="../../assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">      
      </section>
    </div>
  </main>
  <?php
include("../../inc/footer.php");
?>
