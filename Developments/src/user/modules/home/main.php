<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
include("../../inc/header.php");

$query = "SELECT * FROM `categories`";
$rs = mysqli_query($conn, $query);
$count = mysqli_num_rows($rs);
$list_cat = db_fetch_array($query);
$current_date = time();
?>
<div class="body-content outer-top-vs" id="top-banner-and-menu">
  <div class="container">
    <div class="row">
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">

              <!-- /.menu-item -->
              <?php
              if ($count == 0):
                echo "Record not found";
              else:
                foreach ($list_cat as $field) {
                  ?>
                  <li class="dropdown menu-item">
                    <a href="../product/main.php?cat_id=<?= $field['cat_id'] ?>"><?= $field['cat_name'] ?></a>
                    <ul class="dropdown-menu mega-menu">
                      <li class="yamm-content">

                      </li>
                    </ul>
                  </li>

                  <?php
                }
                ;
              endif
              ?>
            </ul>
          </nav>
        </div>
        <!-- /.side-menu -->
        <!-- ================================== TOP NAVIGATION : END ================================== -->

      </div>
      <!-- /.sidemenu-holder -->
      <!-- ============================================== SIDEBAR : END ============================================== -->

      <!-- ============================================== CONTENT ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
        <!-- ========================================== SECTION – HERO ========================================= -->

        <div id="hero">
          <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            <div class="item" style="background-image: url(../../public/assets/images/sliders/01.jpg);">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                  <div class="slider-header fadeInDown-1">In 2023</div>
                  <div class="big-text fadeInDown-1"> TOP BEST SELLER </div>
                  <div class="excerpt fadeInDown-2 hidden-xs"> <span></span> </div>
                  <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product"
                      class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                </div>
                <!-- /.caption -->
              </div>
              <!-- /.container-fluid -->
            </div>
            <!-- /.item -->

            <div class="item" style="background-image: url(../../public/assets/images/sliders/02.jpg);">
              <div class="container-fluid">
                <div class="caption bg-color vertical-center text-left">
                  <div class="slider-header fadeInDown-1">This Summer</div>
                  <div class="big-text fadeInDown-1"> Up To 50% OFF SALE </div>
                  <div class="excerpt fadeInDown-2 hidden-xs"> <span></span> </div>
                  <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product"
                      class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                </div>
                <!-- /.caption -->
              </div>
              <!-- /.container-fluid -->
            </div>
            <!-- /.item -->

          </div>
          <!-- /.owl-carousel -->
        </div>

        <!-- ========================================= SECTION – HERO : END ========================================= -->

        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs">
          <div class="more-info-tab clearfix ">
            <h3 class="new-product-title pull-left">New Arrival</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
              <!-- <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
              <li><a data-transition-type="backSlide" href="#smartphone" data-toggle="tab">Classic</a></li>
              <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Comic</a></li>
              <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Novel</a></li> -->
            </ul>
            <!-- /.nav-tabs -->
          </div>
          <div class="tab-content outer-top-xs">
            <div class="tab-pane in active" id="all">
              <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                  <?php
                  $new_arrival = db_fetch_array("SELECT book.*, discount.discount_per,
                  UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
                  UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
                  FROM book, discount 
                  WHERE book.discount_id= discount.discount_id
                   ORDER BY book_id DESC LIMIT 10");
                  if (count($new_arrival) == 0) {
                    echo "no data";
                  } else {
                    foreach ($new_arrival as $row) {
                      ?>
                      <div class="item item-carousel">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                              <div class="image">
                                <a href="../product/detail.php">
                                  <img src="<?= $row['book_image'] ?>" alt="">
                                </a>
                              </div>
                              <!-- /.image -->

                              <div class="tag new"><span>new</span></div>
                            </div>
                            <!-- /.product-image -->

                            <div class="product-info text-left">
                              <h3 class="name"><a href="../product/detail.php?book_id=<?= $row['book_id'] ?>"><?= $row['book_name'] ?></a></h3>
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
                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                              </li>
                              <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                              <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                            </ul>
                          </div>                         
                        </div> -->
                            <!-- /.cart -->
                          </div>
                          <!-- /.product -->

                        </div>
                        <!-- /.products -->
                      </div>
                      <!-- /.item -->

                      <?php
                    }
                  }
                  ?>


                </div>
                <!-- /.home-owl-carousel -->
              </div>
              <!-- /.product-slider -->
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.scroll-tabs -->
        <!-- ============================================== SCROLL TABS : END ============================================== -->


        <!-- ============================================== FEATURED PRODUCTS ============================================== -->
        <section class="section new-arriavls">
          <h3 class="section-title">Hot Deal</h3>
          <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
            <?php
            $hotdeal = db_fetch_array("SELECT book.*, discount.discount_per,
            UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
            UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end
            FROM book, discount 
            WHERE book.discount_id= discount.discount_id AND discount.discount_per <1 
            AND UNIX_TIMESTAMP() <=UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y'))
            AND UNIX_TIMESTAMP() >=UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y'))
            ORDER BY book_id DESC");
            if (count($hotdeal) == 0) {
              echo "no data";
            } else {
              foreach ($hotdeal as $row) {
                ?>
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image">
                          <a href="../product/detail.php">
                            <img src="<?= $row['book_image'] ?>" alt="">
                          </a>
                        </div>
                        <!-- /.image -->

                        <div class="tag sale"><span>sale</span></div>
                      </div>
                      <!-- /.product-image -->

                      <div class="product-info text-left">
                        <h3 class="name"><a href="../product/detail.php?book_id=<?= $row['book_id'] ?>"><?= $row['book_name'] ?></a></h3>
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
                              <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i
                                  class="fa fa-shopping-cart"></i> </button>
                              <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                            </li>
                            <li class="lnk wishlist"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html"
                                title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                            <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart" href="detail.html"
                                title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                          </ul>
                        </div>                      
                      </div> -->
                      <!-- /.cart -->
                    </div>
                    <!-- /.product -->

                  </div>
                  <!-- /.products -->
                </div>
                <!-- /.item -->

                <?php
              }
            }
            ?>
          </div>
          <!-- /.home-owl-carousel -->
        </section>
        <!-- /.section -->
        <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

      </div>
      <!-- /.homebanner-holder -->
      <!-- ============================================== CONTENT : END ============================================== -->
    </div>
  </div>
  <!-- /.container -->
  <?php
  include("../../inc/footer.php");
  ?>
</div>