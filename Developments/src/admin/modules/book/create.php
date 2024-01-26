<?php
include_once("../../db/DBConnect.php");

$nameErr = $imgErr = $yearErr  = $pageErr = $invenErr = $authorErr = $priceErr="";
$yearbook = $img = $name = $page = $inventory = $Author = $Price = "" ;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["txtYear"])) {
    $yearErr = "year is required";
  } else {
    $yearbook = test_input($_POST["txtYear"]);
    if ($yearbook < 1400 || $yearbook > 2023) {
      $yearErr = "Year is wrong";
    }
  }
  //author validate
  if (empty($_POST["txtAuthor"])) {
    $authorErr = "Author is required";
  } else {
    $Author = test_input($_POST["txtAuthor"]);
  }

  if (empty($_POST["txtName"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["txtName"]);
  }

  // page of book 
  if (empty($_POST["txtPage"])) {
    $pageErr = "year is required";
  } else {
    $page = test_input($_POST["txtPage"]);
    if ($page < 0) {
      $pageErr = "Invalid page";
    }
  }
  // price validation
  if (empty($_POST["txtPrice"])) {
    $priceErr = "price is required";
  } else {
    $Price = test_input($_POST["txtPrice"]);
    if ($Price < 0 ) {
      $priceErr = "Invalid price";
    }
  }

  // inventory
  if (empty($_POST["txtInventory"])) {
    $invenErr = "inventory is required";
    } else {
    $inventory = test_input($_POST["txtInventory"]);
    if ($inventory < 0) {
      $invenErr = "invalid inventory";
    }
  }
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$sql = "select * from categories";
$all_categories = mysqli_query($conn, $sql);
$sql_publisher = "select * from publisher";
$all_publisher = mysqli_query($conn, $sql_publisher);
$sql_discount = "select * from discount";
$all_discount = mysqli_query($conn, $sql_discount);

if (isset($_POST['btnAdd'])):
  $name = $_POST['txtName'];
  $description = $_POST['txtDescription'];
  $Author = $_POST['txtAuthor'];
  $Price = $_POST['txtPrice'];
  $page = $_POST['txtPage'];
  $yearbook = $_POST['txtYear'];
  $categoryid = $_POST['category'];
  $discountid = $_POST['discount'];
  $bookstatus = $_POST['txtBook'];
  $publisherid = $_POST['publisher'];
  $inventory = $_POST['txtInventory'];

  // upload logo
  $folder = "../../../../img/";
  $fileName = $_FILES['txtImg']['name'];
  $fileTmp = $_FILES['txtImg']['tmp_name'];
  $img = $folder . $fileName;

  move_uploaded_file($fileTmp, $img);
  if (empty($nameErr) && empty($imgErr) && empty($priceErr) && empty($authorErr) && 
  empty($yearErr) && empty($pageErr) && empty($invenErr) ):
  $query = "insert into book (book_name, book_des, book_author, book_price, 
        page, book_status, discount_id, cat_id, YearBook, book_image, publisher_id, inventory) values 
        ('{$name}', '{$description}', '{$Author}', '{$Price}', '{$page}', '{$bookstatus}','{$discountid}',
         '{$categoryid}','{$yearbook}', '{$img}', '{$publisherid}', '{$inventory}')";
  $rs = mysqli_query($conn, $query);
  if (!$rs):
    echo 'Nothing to insert!';
  endif;
  header("location:main.php");
endif;
endif;
mysqli_close($conn);
?>
<?php
include_once("../../inc/header.php");
?>
<main id="main" class="main">
  <div class="pagetitle">
  <h1>Add Book</h1>  
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
        <li class="breadcrumb-item"><a href="main.php">Book</a></li>
        <li class="breadcrumb-item active">Book Detail</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add book</h5>
            <form class="row g-3" method="post" enctype="multipart/form-data">
              <div class="col-12">
                <label class="form-label">Name</label>
                <input class="form-control" name="txtName">
                <span class="error" style="color:red"> <?php echo $nameErr; ?></span>
              </div>
              <div class="col-12">
                <label class="form-label">Author</label>
                <input name="txtAuthor" class="form-control">
                <span class="error" style="color:red"> <?php echo $authorErr; ?></span>
              </div>
              <div class="col-12">
                <label class="form-label">Price</label>
                <input type="text" class="form-control" name="txtPrice">
                <span class="error" style="color:red"> <?php echo $priceErr; ?></span>
              </div>
              <div class="col-25">
                <label class="form-label">Description</label>
                <input type="text" class="form-control" name="txtDescription">
              </div>
              <div class="col-12">
                <label class="form-label">Page</label>
                <input type="text" class="form-control" name="txtPage">
                <span class="error" style="color:red"> <?php echo $pageErr; ?></span>
              </div>
              <div class="col-12">
                <label class="form-label">Year of book</label>
                <input type="text" class="form-control" name="txtYear">
                <span class="error" style="color:red"> <?php echo $yearErr; ?></span>
              </div>
              <div class="col-12"> Category
                <select name="category" class="form-control col-12 ">
                  <?php
                  while (
                    $category = mysqli_fetch_array(
                      $all_categories
                    )
                  ):
                    ?>
                    <option value="<?php echo $category["cat_id"];
                    ?>">
                      <?php echo $category["cat_name"];
                      ?>
                    </option>
                    <?php
                  endwhile;
                  ?>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Discount</label>
                <select name="discount" class="form-control col-12 ">
                  <?php
                  while (
                    $discount = mysqli_fetch_array(
                      $all_discount
                    )
                  ):
                    ?>
                    <option value="<?= $discount['discount_id'];
                    ?>">
                      <?php echo $discount['discount_name'];
                      ?>
                    </option>
                  <?php
                  endwhile;
                  ?>
              </div>
              </select>
              <div class="col-12">
                <label class="form-label">Publisher</label>
                <select name="publisher" class="form-control col-12 ">
                  <?php
                  while (
                    $publisher = mysqli_fetch_array(
                      $all_publisher
                    )
                  ):
                    ?>
                    <option value="<?php echo $publisher["publisher_id"];
                    ?>">
                      <?php echo $publisher["publisher_name"];
                      ?>
                    </option>
                  <?php
                  endwhile;
                  ?>
              </div>
              </select>
              <div class="col-12">
                <label class="form-label">oo</label>
                <input type="text" class="form-control" name="txtBook">
              </div>
              <div class="col-12">
                <label class="form-label">Inventory</label>
                <input type="text" class="form-control" name="txtInventory">
                <span class="error" style="color:red"> <?php echo $invenErr; ?></span>
              </div>
              <div class="col-12">
                <label class="form-label">Book Image</label>
                <input class="form-control" type="file" name="txtImg">
                <span class="error" style="color:red"> <?php echo $imgErr; ?></span>
              </div>
              <div class="text-center">
                <input type="submit" class="btn btn-primary" name="btnAdd" value="Submit">
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
include_once("../../inc/footer.php");
?>