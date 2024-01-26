<?php
session_start();
// include("../../inc/header.php");
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
if (!isset($_GET['book_id'])):
  header("../../home/main.php");
endif;
if(isset($_SESSION['user_login']['id'])){
  $user_id = (int) $_SESSION['user_login']['id'];  
}
$current_date = time();
$book_id = $_GET['book_id'];
$book_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT book.*, publisher.*, 
discount.discount_per, discount.discount_name,
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_start, '%d/%m/%Y')) as discount_start, 
UNIX_TIMESTAMP(STR_TO_DATE(discount.discount_end, '%d/%m/%Y')) as discount_end, discount.discount_name 
FROM `book`, publisher, discount  
WHERE book_id = '{$book_id}' and book.publisher_id = publisher.publisher_id and book.discount_id = discount.discount_id"));
$detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories, book 
WHERE categories.cat_id=book.cat_id AND book.book_id = '{$book_id}' "));
$sql = "SELECT * FROM feedback, book, customer where feedback.book_id=book.book_id AND feedback.customer_id = customer.id and book.book_id = '{$book_id}'";
$rs_feedback = db_fetch_array($sql);

$ratingErr = "";
$content = $rating = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["txtcontent"])) {
    $content = "";
  } else {
    $content = test_input($_POST["txtcontent"]);
  }

  if (empty($_POST["rate"])) {
    $ratingErr = "Rating is required";
  }
  else {
    $rating = $_POST["rate"];
  }
}
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if (isset($_POST['btnAddReview'])):
  if (empty($ratingErr)):
    // echo '<h2 style="color:blue">Welcome '. $sName . ' to my service</h2>';
    $query = "INSERT INTO `feedback` ( `content`, `rating`, `book_id`, `customer_id`) 
    VALUES ( '{$content}', '{$rating}', '{$book_id}', '{$user_id}');";
    $rs = mysqli_query($conn, $query);
    if (!$rs):
      echo 'can not found';
    endif;
   header("Location:detail.php?book_id=$book_id");
  endif;
endif;

?>
<?php
include("../../inc/header.php");
?>
<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="../home/main.php">Home</a></li>
        <li><a href="#"> <?= $detail['cat_name'] ?></a></li>      
        <li class='active'>
          <?= $detail['book_name'] ?>
        </li>
      </ul>
    </div><!-- /.breadcrumb-inner -->
  </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row single-product'>
      <div class='col-xs-12 col-sm-12 col-md-3 sidebar'>
        <div class="sidebar-module-container">
          <div class="home-banner outer-top-n outer-bottom-xs">
            <img src="../../public/assets/images/banners/LHS-banner.jpg" alt="Image">
          </div>

        </div>
      </div><!-- /.sidebar -->
      <div class='col-xs-12 col-sm-12 col-md-9 rht-col'>
        <div class="detail-block">
          <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 gallery-holder">
              <div class="product-item-holder size-big single-product-gallery small-gallery">

                <div id="owl-single-product" method="post">
                  <div class="single-product-gallery-item" id="slide1">
                    <img class="img-responsive" src="<?= $book_detail['book_image'] ?>"
                      data-echo="<?= $book_detail['book_image'] ?>" />
                    </a>
                  </div><!-- /.single-product-gallery-item -->

                </div><!-- /.single-product-slider -->


                <div class="single-product-gallery-thumbs gallery-thumbs">

                </div><!-- /.gallery-thumbs -->

              </div><!-- /.single-product-gallery -->
            </div><!-- /.gallery-holder -->
            <div class='col-sm-12 col-md-8 col-lg-8 product-info-block'>
              <form action="../cart/add.php" method="POST">
                <div class="product-info">
                  <h1 class="name">
                    <?= $detail['book_name'] ?>
                  </h1>

                  <div class="rating-reviews m-t-20">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="pull-left">
                          <div class="rating rateit-small"></div>
                        </div>
                        <div class="pull-left">
                          <div class="reviews">
                            <a href="#" class="lnk">(<?= count($rs_feedback)?> Reviews)</a>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.row -->
                  </div><!-- /.rating-reviews -->

                  <div class="stock-container info-container m-t-10">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="pull-left">
                          <div class="stock-box">
                            <span class="label">Availability :</span>
                          </div>
                        </div>
                        <div class="pull-left">
                          <div class="stock-box">
                            <span class="value"> <?= $detail['inventory']>0 ?'In Stock':'Not in Stock' ?></span>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.row -->
                  </div><!-- /.stock-container -->

                  <div class="description-container m-t-20">
                    <p>Author:
                      <?= $detail['book_author'] ?>
                    </p>
                    <p>Publisher:
                      <?= $book_detail['publisher_name'] ?>
                    </p>
                    <p>publication Year:
                      <?= $detail['YearBook'] ?>
                    </p>
                    <p>Page:
                      <?= $detail['page'] ?>
                    </p>
                  </div>

                  <div class="price-container info-container m-t-30">
                    <div class="row">


                      <div class="col-sm-6 col-xs-6">
                        <div class="price-box">
                          <span class="price">$
                            <?php 
                             if ($current_date >= $book_detail['discount_start'] && $current_date <= $book_detail['discount_end']) {
                              echo $book_detail['book_price'] * $book_detail['discount_per'];
                            } else {
                              echo $book_detail['book_price'];
                            } 
                            ?>
                          </span>
                          <span class="price-strike">
                          <?php
                                    if ($current_date >= $book_detail['discount_start'] && $current_date <= $book_detail['discount_end']) {
                                      echo '$' . $book_detail['book_price'];
                                    } else {
                                      echo '';
                                    }
                                    ?>
                          </span>
                          
                          <?php
                                    if ($current_date >= $book_detail['discount_start'] && $current_date <= $book_detail['discount_end']) {
                                      echo "<span style='margin-left: 4px;
                                      padding: 12px;
                                      border: none;
                                      border-radius: 3px;
                                      background-image: linear-gradient(0, #ea5c2e, #f5aa39);
                                      color: white;'>"."- ".($book_detail['discount_per']*100)."%"."</span>";                                 
                                      } else {
                                      echo '';
                                    }
                                    ?>
                          
                        </div>
                      </div>

                      <!-- <div class="col-sm-6 col-xs-6">
                        <div class="favorite-button m-t-5">
                          <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist"
                            href="#">
                            <i class="fa fa-heart"></i>
                          </a>
                          <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare"
                            href="#">
                            <i class="fa fa-signal"></i>
                          </a>
                          <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail"
                            href="#">
                            <i class="fa fa-envelope"></i>
                          </a>
                        </div>
                      </div> -->

                    </div><!-- /.row -->
                  </div><!-- /.price-container -->

                  <div class="quantity-container info-container">
                    <div class="row">

                      <div class="qty">
                        <span class="label">Qty :</span>
                      </div>
                      <div class="qty-count">
                        <div class="cart-quantity">
                          <div class="quant-input">
                            <div class="arrows">
                              <div class="arrow plus gradient"><span class="ir"><i
                                    class="icon fa fa-sort-asc"></i></span></div>
                              <div class="arrow minus gradient"><span class="ir"><i
                                    class="icon fa fa-sort-desc"></i></span></div>
                            </div>
                            <input type="text" name="qty" id="input-qty" value="1"
                             oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />                           
                          </div>
                        </div>                       
                      </div>
                      <div class="add-btn" data-id="<?= $detail['book_id'] ?>"
                        data-price="<?= (($current_date >= $book_detail['discount_start'] && $current_date<=$book_detail['discount_end']))?
                              $book_detail['book_price']*$book_detail['discount_per']:$book_detail['book_price']
                              ?>">
                        <input type="submit" name="btnAdd" class="btn btn-primary" value="add"></input>
                      </div>
                      <?php

                      ?>
                    </div><!-- /.row -->
                  </div><!-- /.quantity-container -->
                </div><!-- /.product-info -->
              </form>
            </div><!-- /.col-sm-7 -->
          </div><!-- /.row -->
        </div>

        <div class="product-tabs inner-bottom-xs">
          <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
              <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                <!-- <li><a data-toggle="tab" href="#tags">TAGS</a></li> -->
              </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">

              <div class="tab-content">

                <div id="description" class="tab-pane in active">
                  <div class="product-tab">
                    <p class="text">
                      <?= $book_detail['book_des'] ?>
                    </p>
                  </div>
                </div><!-- /.tab-pane -->
                <div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
											<h4 class="title">Customer Reviews</h4>
                      <?php
                      if(count($rs_feedback)==0){
                        echo "no data";
                      }else{
                        foreach($rs_feedback as $feedback){
                          ?>
                          	<div class="reviews">
												<div class="review">
													<div class="review-title"><span class="summary"><?= $feedback['name']?></span>                          
                          </div>
                          <div><?= $feedback['rating']?><i class="fa fa-star" style="color: orange"></i></div>
													<div class="text"><?= $feedback['content']?></div>
																										</div>
											
											</div><!-- /.reviews -->

                          <?php
                        }
                      }
                      
                      ?>
                     

										
										</div><!-- /.product-reviews -->
										<?php
                    if(!isset($_SESSION['user_login'])){
                        echo "Only registered users can write reviews. Please,  <a href='../login/login.php'>log in</a> or <a href='../login/register.php'>register</a>  ";
                    } else {
                      echo "<div class='product-add-review'>
                      <form method='POST' action=''>
                        <h4 class='title'>Write your own review</h4>
                        <div class='review-table'>
                          <div class='table-responsive'>
                            <table class='table'>	
                              <thead>
                                <tr>
                                  <th class='cell-label'>&nbsp;</th>
                                  <th>1 star</th>
                                  <th>2 stars</th>
                                  <th>3 stars</th>
                                  <th>4 stars</th>
                                  <th>5 stars</th>
                                </tr>
                              </thead>	
                              <tbody>
                                <tr>
                                  <td class='cell-label'>Rating</td>
                                  <td><input type='radio' name='rate' class='radio' value='1'></td>
                                  <td><input type='radio' name='rate' class='radio' value='2'></td>
                                  <td><input type='radio' name='rate' class='radio' value='3'></td>
                                  <td><input type='radio' name='rate' class='radio' value='4'></td>
                                  <td><input type='radio' name='rate' class='radio' value='5'></td>
                                </tr>															
                              </tbody>
                            </table><!-- /.table .table-bordered -->
                          </div><!-- /.table-responsive -->
                        </div><!-- /.review-table -->
                        <div style='color:red'>".$ratingErr."
                        </div>
                        
                        <div class='review-form'>
                          <div class='form-container'>										
                            <div class='row'>														
                              <div class='col-md-12'>
                                  <div class='form-group'>
                                    <label for='exampleInputReview'>Review <span class='astk'></span></label>
                                    <textarea class='form-control txt txt-review' id='exampleInputReview' name='txtcontent'
                                    rows='4' placeholder=''></textarea>
                                  </div>
                                </div>
                              </div>														
                              <div class='action text-right'>
                                <input  type='submit' name ='btnAddReview' class='btn btn-primary btn-upper' value='SUBMIT'>
                              </div>											
                          </div>
                        </div>
                        </form>
                    </div>										
                  ";
                    }
                    ?>

										

                </div><!-- /.product-tab -->
							</div><!-- /.tab-pane -->





                

              </div><!-- /.tab-content -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.product-tabs -->
        <!-- ============================================== UPSELL PRODUCTS ============================================== -->


        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
      </div><!-- /.container -->
    </div><!-- /.body-content -->



    <?php
    include("../../inc/footer.php");
    ?>