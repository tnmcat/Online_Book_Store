<?php
session_start();
include("../../inc/header.php");
include("../../db/DBConnect.php");
include("../../db/database.php");

if (!isset($_GET['cat_id'])):
  header("location:../home/main.php");
endif;
$cat_id = $_GET['cat_id'];
$query = "SELECT book.*, discount.discount_per,
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end  FROM book, discount
WHERE book.discount_id= discount.discount_id 
AND book.cat_id =$cat_id GROUP BY book.book_id";

$current_date = time();

$list_book = db_fetch_array("SELECT book.*, discount.discount_per,
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
FROM book, discount
WHERE book.discount_id= discount.discount_id 
AND book.cat_id =$cat_id GROUP BY book.book_id");
$list_author = db_fetch_array("SELECT DISTINCT book.book_author from book
WHERE book.cat_id = {$cat_id}");
$list_publisher = db_fetch_array("SELECT DISTINCT publisher.publisher_name, publisher.publisher_id  from book, publisher 
WHERE book.publisher_id = publisher.publisher_id AND book.cat_id = {$cat_id}");

//filter
$errorFilter ='';
if (isset($_POST['btnFilter'])) { 
  if (isset($_POST['author'])&&isset($_POST['publisher_id'])) { 
    $author = $_POST['author'];
    $publisher_id = $_POST['publisher_id'];
    $query = "SELECT book.*, discount.discount_per,
    UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
    UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end FROM book, discount
  WHERE book.discount_id= discount.discount_id AND book.book_author = '{$author}' AND book.publisher_id = $publisher_id
  AND book.cat_id =$cat_id GROUP BY book.book_id";
  } else{
    $errorFilter = 'Must choose Author and Publisher';
  }
}
$list_book = db_fetch_array($query);
?>
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
        <div class="sidebar-module-container">
          <div class="sidebar-filter">
            <form method="POST" action="">
              <div class="sidebar-widget">
                <h3 class="section-title">Shop by</h3>
                <div class="sidebar-widget-body">
                </div>
              </div>
              <div class="sidebar-widget">
                <div class="widget-header">
                  <h4 class="widget-title">Publisher</h4>
                </div>
                <div class="sidebar-widget-body">
                  <div>
                    <?php
                    if (count($list_publisher) == 0) {
                      echo "no data";
                    } else {
                      foreach ($list_publisher as $field) {
                        ?>
                        <input type="hidden" name="publisher_id" value="<?= $field['publisher_id'] ?>">
                        <input type="radio" name="publisher" value="<?= $field['publisher_name'] ?>">
                        <?= $field['publisher_name'] ?><br>
                        <?php
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="sidebar-widget">
                <div class="widget-header">
                  <h4 class="widget-title">Author</h4>
                </div>
                <div class="sidebar-widget-body">
                  <div>
                    <?php
                    if (count($list_author) == 0) {
                      echo "no data";
                    } else {
                      foreach ($list_author as $field) {
                        ?>
                        <input type="radio" name="author" value="<?= $field['book_author'] ?>"> <?= $field['book_author'] ?><br>
                        <?php
                      }
                    }
                    ?>
                  </div>
                </div>              
              </div>
              <div class="sidebar-widget">
                  <div>
                <p><?= $errorFilter;              
              ?></p></div>              
              </div>              
              <div class="sidebar-widget">
                <div class="sidebar-widget">
                  <div class="sidebar-widget-body m-t-10">
                    <input type="submit" name="btnFilter" class="lnk btn btn-primary" value="Shop Now">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-9 rht-col">
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <div class="col col-sm-6 col-md-3 col-lg-3 col-xs-6">
              <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row">
                  <?php
                  if (count($list_book) == 0) {
                    echo "no data";
                  } else {
                    foreach ($list_book as $row) {
                      ?>
                      <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="item">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image">
                                  <a href="">
                                    <img src="<?php echo $row['book_image'] ?>" alt="">
                                    <img src="<?php echo $row['book_image'] ?>" alt="" class="hover-image">
                                  </a>
                                </div>                             

                                <div class="tag new"><span>new</span></div>
                              </div>                          
                              <div class="product-info text-left">
                                <h3 class="name"><a href="../product/detail.php?book_id=<?php echo $row['book_id'] ?>"><?php echo $row['book_name'] ?></a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="description"></div>
                                <div class="product-price"> <span class="price"> $
                                    <?php
                                    if ($current_date >= $row['discount_start'] && $current_date <= $row['discount_end']) {
                                      echo $row['book_price'] * $row['discount_per'];
                                    } else {
                                      echo $row['book_price'];
                                    }
                                    ?>
                                  </span> <span class="price-before-discount">
                                    <?php
                                    if ($current_date >= $row['discount_start'] && $current_date <= $row['discount_end']) {
                                      echo '$' . $row['book_price'];
                                    } else {
                                      echo '';
                                    }
                                    ?>
                                  </span>
                                </div>

                              </div>
                              <!-- /.product-info -->
                              <!-- <div class="cart clearfix animate-effect">
                                <div class="action">
                                  <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                      <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                                          class="fa fa-shopping-cart"></i> </button>
                                      <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                  </ul>
                                </div>
                               
                              </div> -->
                              <!-- /.cart -->
                            </div>
                            <!-- /.product -->

                          </div>
                          <!-- /.products -->
                        </div>
                      </div>
                      <!-- /.item -->
                      <?php
                    }
                  }
                  ?>
                </div>
                <!-- /.row -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("../../inc/footer.php");
?>