<?php
include("../../inc/header.php");
include_once("../../db/DBConnect.php");

$query = "SELECT * from book, categories, publisher  where 
book.cat_id = categories.cat_id and 
book.publisher_id = publisher.publisher_id";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);

?>

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
                <li class="breadcrumb-item">Book</li>
                <li class="breadcrumb-item active">Book Detail</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                    <h5><a href="create.php">Add book</a></h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Book ID</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Book Author</th>
                                    <th scope="col">Book Price</th>
                                    <!-- <th scope="col">Book Description</th> -->
                                    <th scope="col">Book Pages</th>
                                    <th scope="col">Book Publisher</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($count == 0):
                                    echo 'Record not found!';
                                else:
                                    while ($row = mysqli_fetch_array($rs)):
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['book_id'] ?>
                                            </td>
                                            <td>
                                                <?= $row['book_name'] ?>
                                            </td>
                                            <td>
                                                <?= $row['book_author'] ?>
                                            </td>
                                            <td>
                                                <?= $row['book_price'] ?>
                                            </td>
                                            <!-- <td>
                                                <?= $row['book_des'] ?>
                                            </td> -->
                                            <td>
                                                <?= $row['page'] ?>
                                            </td>
                                            <td>
                                                <?= $row['publisher_name'] ?>
                                            </td>
                                            <td>
                                                <?= $row['cat_name'] ?>
                                            </td>
                                            <td>
                                                <img src="<?= $row['book_image']?>" width="100">
                                            </td>
                                            <td>
                                                <a href="edit.php?id=<?= $row['book_id'] ?>">Edit</a>
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
