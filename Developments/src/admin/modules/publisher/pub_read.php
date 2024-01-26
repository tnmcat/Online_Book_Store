<?php
session_start();
include("../../inc/header.php");
include_once("../../db/DBConnect.php");

$query = "select * from publisher";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Publisher</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
                <li class="breadcrumb-item">Book</li>
                <li class="breadcrumb-item active">Publisher</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <a href="pub_create.php" class="card-title">New Publisher</a>                       
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name</th>                                   
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
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
                                            <td>
                                                <?= $fields[0] ?>
                                            </td>
                                            <td><img src="<?= $fields[2] ?>" width="100"></td>
                                            <td>
                                                <a href="<?= $fields[3] ?>"> <?= $fields[1] ?></a>                                               
                                            </td>                                           
                                            <td>
                                                <?= $fields[4] ?>
                                            </td>
                                            <td>
                                                <?= $fields[5] ?>
                                            </td>
                                            <td>
                                                <?= $fields[6] ?>
                                            </td>
                                            <td>
                                                <a href="pub_update.php?code=<?= $fields[0] ?>">Edit</a>
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