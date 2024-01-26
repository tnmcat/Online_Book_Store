<?php 
session_start();
include("../../inc/header.php");
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");

$query = "select * from discount";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Discount Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">Discount</li>
        </ol>
      </nav>
    </div>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <a href="create.php" class="card-title">New Discount</a>           
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Percentage</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Function</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if ($count == 0):
                            echo 'Record not found!';
                        else:
                            while ($fields = mysqli_fetch_array($rs)):
                                ?>
                                <tr>
                                    <td><?= $fields[0] ?></td>
                                    <td><?= $fields[1] ?></td>
                                    <td><?= $fields[2] ?></td>
                                    <td><?= $fields[3] ?></td>
                                    <td><?= $fields[4] ?></td>
                                    <td><?= $fields[5] ?></td>
                                    <td>
                                        <a href="update.php?code=<?= $fields[0] ?>">Edit</a>
                                        <!-- <a href="delete.php?code=<?= $fields[0] ?>"
                                        onclick="return confirm('Are you sure to delete Item <?= $fields[0] ?>')">Delete</a> -->
                                    </td>
                                </tr>
                        <?php
                            endwhile;
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