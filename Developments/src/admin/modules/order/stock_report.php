<?php
session_start();
include("../../inc/header.php");
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
$stock_report = db_fetch_array("SELECT book_id, book_name, inventory FROM `book`");
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Inventory</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
        <li class="breadcrumb-item">Statistics</li>
        <li class="breadcrumb-item active">Inventory</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">Book ID</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Inventory</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (count($stock_report) == 0) {
                  echo "No data";
                } else {
                  foreach ($stock_report as $row) {
                    ?>
                    <tr>
                      <th scope="row">
                        <?= $row['book_id'] ?>
                      </th>
                      <td>
                        <?= $row['book_name'] ?>
                      </td>
                      <td>
                        <?= $row['inventory'] ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
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