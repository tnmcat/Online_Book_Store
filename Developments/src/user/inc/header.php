<?php
// var_dump($_SESSION['user_login']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>OnbookStore</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="../../public/assets/css/main.css">
<link rel="stylesheet" href="../../public/assets/css/blue.css">
<link rel="stylesheet" href="../../public/assets/css/owl.carousel.css">
<link rel="stylesheet" href="../../public/assets/css/owl.transitions.css">
<link rel="stylesheet" href="../../public/assets/css/animate.min.css">
<link rel="stylesheet" href="../../public/assets/css/rateit.css">
<link rel="stylesheet" href="../../public/assets/css/bootstrap-select.min.css">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="../../public/assets/css/font-awesome.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow:200,300,300i,400,400i,500,500i,600,700,800" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


</head>

<body class="cnt-home">
  <header class="header-style-1">
    <div class="top-bar animate-dropdown">
    </div>
    <div class="main-header">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
            <div class="logo"> <a href="../home/main.php"> <img src="../../public/assets/images/logo.png" alt="logo">
              </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-6 col-sm-8 col-xs-12 top-search-holder">
            <div class="search-area">
              <form action="../home/search.php" method="post">
                <div class="control-group">
                  <input class="search-field" name="search_data" placeholder="Enter keyword..." />
                  <input type="submit" class="search-button" name="btnSearch" value="Search">
                </div>
              </form>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 animate-dropdown top-cart-row">
            <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                <div class="items-cart-inner">
                  <div class="basket">
                    <div class="basket-item-count"><span class="count">
                        <?php
                        if (isset($_SESSION['cart'])) {
                          echo count($_SESSION['cart']);
                        } else
                          echo "0"
                            ?>
                        </span></div>
                      <div class="total-price-basket"> </div>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <?php
                        if (!isset($_SESSION['cart'])) {
                          echo "No item";
                        } else {
                          foreach ($_SESSION['cart'] as $item) {
                            ?>
                    <li>
                      <div class="cart-item product-summary">
                        <div class="row">
                          <div class="col-xs-4">
                            <!-- <div class="image"> <a href="detail.html"><img src="assets/images/products/p4.jpg" alt=""></a>
                            </div> -->
                          </div>
                          <div class="col-xs-7">
                            <h3 class="name"><a href="index8a95.html?page-detail">
                                <?= $item['book_name'] ?>
                              </a></h3>
                            <div class="price">$
                              <?= $item['book_price'] ?>
                            </div>
                            X <span id="qty-book-id-<?= $item['book_id'] ?>"><?= $item['qty'] ?></span>
                          </div>
                        </div>
                      </div>
                    </li>

                    <?php
                          }
                        }
                        ?>
                <li>
                  <div class="clearfix"></div>
                  <hr>
                  <div class="clearfix cart-total">
                    <div class="pull-right"> <span class="text">Total :$</span><span id="total">
                        <?php
                        $total = 0;
                        if (!isset($_SESSION['cart'])) {
                          echo "0";
                        } else {
                          foreach ($_SESSION['cart'] as $item) {
                            $total += $item['subtotal'];
                          }
                          echo $total;
                        }
                        ?>
                      </span> </div>
                    <div class="clearfix"></div>
                    <a href="../cart/show.php" class="btn btn-upper btn-primary btn-block m-t-20">View Cart</a>
                  </div>
                  <!-- /.cart-total-->
                </li>

              </ul>
              <!-- /.dropdown-menu-->
            </div>  
            <?php
            if(isset($_SESSION['user_login'])){
              echo "<div class='dropdown dropdown-cart'> 
              <a href='#' class='dropdown-toggle lnk-cart' data-toggle='dropdown'>
                <div class='items-cart-inner'>
                  <div style='padding-right: 30px; padding-top: 8px;'>
                  <div><span style='display: flex; flex-direction: column; align-items: center;'> <i class='fa fa-user' style='font-size:24px'> <br> </i> Hi, ".$_SESSION['user_login']['name']." </span></div>
                  </div>
                </div>
              </a>
              <ul class='dropdown-menu' style='width:180px;'>
                <li>
                  <a href='../login/show-info.php'>My Profile</a>  
                  <hr>           
                </li>              
                <li>
                  <a href='../login/change-pass.php'>Change Password</a>  
                  <hr>           
                </li>              
                <li>
                  <a href='../checkout/show_order.php'>My Order</a>  
                  <hr>           
                </li>              
                <li>
                  <a href='../login/logout.php'>Log out</a>                
                  <hr> 
                </li>      
              </ul>             
            </div>";
            }
            else {
              echo " <div class='dropdown dropdown-cart'> 
              <a href='#' class='dropdown-toggle lnk-cart' data-toggle='dropdown'>
                <div class='items-cart-inner'>
                  <div style='padding-right: 30px; padding-top: 8px;'>
                  <div><span style='display: flex; flex-direction: column; align-items: center;'> <i class='fa fa-user' style='font-size:24px'> <br> </i> Account</span></div>
                  </div>
                </div>
              </a>
              <ul class='dropdown-menu' style='width:180px;''>
                <li>
                  <div class='clearfix cart-total'>
                    <a href='../login/login.php' class='btn btn-upper btn-primary btn-block m-t-20'>Log in</a> </div>
                  
                </li>
                <li>
                  <div class='clearfix cart-total'>
                    <a href='../login/register.php' class='btn btn-upper btn-primary btn-block m-t-20'>Register</a> 
                  </div>
                  
                </li>
              </ul>             
            </div>";
            }
            ?>  
          </div>
        </div>
      </div>
    </div>
    </div>
  </header>
  <!-- ============================================== HEADER : END ============================================== -->