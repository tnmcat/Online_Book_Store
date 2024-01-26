<?php
session_start();
include_once '../../db/DBConnect.php';
include_once '../../db/database.php';

$query = "select * from customer";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
?>
<?php
include("../../inc/header.php");
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Customer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
        <li class="breadcrumb-item">Customer</li>
        <li class="breadcrumb-item active">Customer Information</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-xl-20">
        <div class="card">
          <div class="card-body ">
            <h5 class="card-title">Customer Information</h5>


            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Address</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Is Block</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($count == 0):
                  echo 'Record not found!';
                else:
                  foreach (db_fetch_array($query) as $fields) {
                    ?>

                    <tr>
                      <td>
                        <?= $fields['id'] ?>
                      </td>
                      <td>
                        <?= $fields['name'] ?>
                      </td>
                      <td>
                        <?= $fields['email'] ?>
                      </td>
                      <td>
                        <?= $fields['phone'] ?>
                      </td>
                      <td>
                        <?= $fields['address'] ?>
                      </td>
                      <td>
                        <?= $fields['gender'] ? "Male" : "Female" ?>
                      </td>
                      <td>
                        <?= $fields['is_block'] ? "Yes" : "No" ?>
                      </td>
                      <td>
                        <a href="edit.php?id=<?= $fields['id'] ?>">Edit</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ;
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<?php
include("../../inc/footer.php");
?>