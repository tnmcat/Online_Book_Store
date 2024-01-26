<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
include_once("../../inc/header.php");

$current_date = time();
$query = "SELECT book.*, discount.discount_per,
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
FROM book, discount
WHERE book.discount_id= discount.discount_id ";

if (isset($_POST['btnSearch'])) {
  $search = $_POST['search_data'];
  if ($search != '') {
    $query = "SELECT book.*, discount.discount_per,
    UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
    UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
    FROM book, discount
    WHERE book.discount_id= discount.discount_id AND book_name like '%" . $search . "%'";
  }
} else {
  $query = "SELECT book.*, discount.discount_per,
  UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
  UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
  FROM book, discount
  WHERE book.discount_id= discount.discount_id ";
}
$rs = mysqli_query($conn, $query);
$num_row = mysqli_num_rows($rs);
// $rs = db_fetch_array($query);
// echo "<pre>";
// print_r($rs);
// echo $current_date;
// echo "</pre>";
?>
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row">
                  <?php
                  if ($num_row == 0) {
                    echo "No data";
                  } else {
                    while ($row = mysqli_fetch_assoc($rs)) {
                      ?>
                      <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="item">
                          <div class="products">
                            <div class="product">
                              <div class="product-image">
                                <div class="image">
                                  <a href="">
                                    <img src="<?= $row['book_image'] ?>" alt="">

                                  </a>
                                </div>
                                <!-- /.image -->

                                <div class="tag new"><span>new</span></div>
                              </div>
                              <!-- /.product-image -->

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
                                <!-- /.product-price -->

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
                                    <li class="lnk wishlist"> <a class="add-to-cart"
                                        href="../product/main.php?book_id=<?php echo $row['book_id'] ?>" title="Wishlist">
                                        <i class="icon fa fa-heart"></i> </a> </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                                          class="fa fa-signal"></i> </a> </li>
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