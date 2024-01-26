<?php
session_start();
 $date_from = strtotime($_POST['date_from']);
 $date_to = strtotime($_POST['date_to']);
 echo $date_from;
 echo "----";
 echo $date_to;
 
 die();

if(isset($_POST['btnFilter'])){
    $date_from = date('Y-m-d', $_POST['date_from']);
    $date_to = date('Y-m-d', $_POST['date_to']);
   
    if(!empty($from_date)&&!empty($to_date)){
      $query = "SELECT SUM(quantity*book_price) as total, ordermaster.order_id, customer.fullname, ordermaster.order_id, ordermaster.order_date, ordermaster.order_status 
      FROM orderdetail, ordermaster, customer 
      WHERE orderdetail.order_id = ordermaster.order_id 
      AND ordermaster.cus_id = customer.id 
      AND ordermaster.order_date >='$date_from' 
      AND ordermaster.order_date <='$date_to' 
      GROUP BY orderdetail.order_id";
    }
    }
    $order_list = array();
    while($row = mysqli_fetch_assoc(mysqli_query($conn,$query))){
        $order_list = $row;
    }
    show_array($order_list);
?>

<main id="main" class="main">

  <div class="pagetitle">
    <!-- <h1>Sale Report</h1> -->
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../home/main.php">Home</a></li>
        <li class="breadcrumb-item">Order</li>
        <!-- <li class="breadcrumb-item active">Sale</li> -->
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <form method="POST" action="#">
          <div class="card-body">
            <h5 class="card-title">Filter</h5>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">From</label>
              <div class="col-sm-3">
                <input type="date" name="date_from" class="form-control" value="">
              </div>
              <label for="inputDate" class="col-sm-2 col-form-label">To</label>
              <div class="col-sm-3">
                <input type="date" name="date_to" class="form-control" value="">
              </div>
              <div class="col-sm-2"><button class="btn btn-primary" name="btnFilter">Filter</button></div>
            </div>
          </div>
          </form>
        </div>

        <div class="card-body">

          <!-- Table with stripped rows -->
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Order Status</th>
                <th scope="col">Total</th>
                <th scope="col">Order Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (count($order_list) == 0) {
                echo "Record not found";
              } else {
                foreach ($order_list as $item) {
                  ?>
                  <tr>
                    <th scope="row"><a
                        href="?mod=order&act=detail&order_id=<?= $item['order_id'] ?>">#<?= $item['order_id'] ?></a></th>
                    <td>
                      <?= $item['fullname'] ?>
                    </td>
                    <td><a href="?mod=order&act=detail&order_id=<?= $item['order_id'] ?>" class="text-primary"><?= $item['order_status'] ?></a></td>
                    <td>
                      <?= $item['total'] ?>
                    </td>
                    <td><span>
                        <?= $item['order_date'] ?>
                      </span></td>
                    <td><a href="?mod=order&act=detail&order_id=<?= $item['order_id']?>">Edit</a></td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
    </div>
  </section>

</main><!-- End #main -->