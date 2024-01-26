<?php
session_start();
include_once("../../db/DBConnect.php");
include_once("../../db/database.php");
include("../../inc/header.php");


	$list_cart = array();
	if (isset($_SESSION['cart'])) {		
		$list_cart = $_SESSION['cart'];
		$total =0;
		foreach($list_cart as $item){
			$total += $item['subtotal'];
		}
		$count_item = count($_SESSION['cart']);
	}

?>



<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="../home/main.php">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<?php
		if (count($list_cart) == 0):
			echo "No item in cart";
		else:
			?>

			<form action="../checkout/main.php" method="POST">
				<div class="row ">
					<div class="shopping-cart">
						<div class="shopping-cart-table ">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<!-- <th class="cart-description item">Image</th> -->
											<th class="cart-product-name item">Book Name</th>
											<th class="cart-qty item">Quantity</th>
											<th class="cart-sub-total item">Price</th>
											<th class="cart-total last-item">Subtotal</th>
											<th class="cart-romove item">Remove</th>
										</tr>
									</thead><!-- /thead -->

									<tbody>
										<?php foreach ($list_cart as $item):

											?>
											<tr>
												<!-- <td class="cart-image">
														<img src="<?= $item['book_image']?>">													
												</td> -->
												<td class="cart-product-name-info">
													<h4 class='cart-product-description'><a
															href="../product/detail.php?book_id=<?= $item['book_id'] ?>">
															<?= $item['book_name'] ?>
														</a></h4>										
												</td>

												<td class="cart-product-quantity">
													<div class="quant-input">
														<input class="input-qty" type="number" style="width:100px" min="1" max="100" 
														data-price="<?= $item['book_price']?>"
														data-id="<?= $item['book_id']?>"
														value="<?= $item['qty'] ?>">
													</div>
												</td>
												
												<td class="cart-product-grand-total"><span class="subtotal"
														>$<?= $item['book_price']?></span>
												</td>
												<td class="cart-product-sub-total">
													<span class="cart-sub-total-price" id="subtotal-<?= $item['book_id']?>">$<?= $item['subtotal'] ?></span>
												</td>
												<td class="remove-item"
													onclick="return confirm('Are you sure to delete this item ?')"><a
														href="delete.php?book_id=<?= $item['book_id'] ?>"
														title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
											</tr>
											<?php
										endforeach;
										?>


									</tbody><!-- /tbody -->

									<tfoot>
										<tr>
											<td colspan="7">
												<div class="shopping-cart-btn">
													<span class="">
														<a href="../home/main.php"
															class="btn btn-upper btn-primary outer-left-xs">Continue
															Shopping</a>
														<a href="delete.php?book_id"
															onclick="return confirm('Are you sure to delete all items ?')"
															class="btn btn-upper btn-primary pull-right outer-right-xs">Delete
															all shopping cart</a>
													</span>
												</div><!-- /.shopping-cart-btn -->
											</td>
										</tr>
									</tfoot>
								</table><!-- /table -->
							</div>
						</div><!-- /.shopping-cart-table -->
						<div class="col-md-4 col-sm-12 estimate-ship-tax">

						</div><!-- /.estimate-ship-tax -->

						<div class="col-md-4 col-sm-12 estimate-ship-tax">
							<table class="table">

							</table><!-- /table -->
						</div><!-- /.estimate-ship-tax -->

						<div class="col-md-4 col-sm-12 cart-shopping-total">
							<table class="table">
								<thead>
									<tr>
										<th>
											<div class="cart-sub-total">
												Shipping Fee<span class="inner-left-md">Free</span>
											</div>
											<div class="cart-grand-total">
												Overal Total<span class="inner-left-md" id="overall_total">
												<?= $total?>
												</span><span>$</span>
											</div>
										</th>
									</tr>
								</thead><!-- /thead -->
								<tbody>
									<tr>
										<td>
											<div class="cart-checkout-btn pull-right">
												<button type="submit" class="btn btn-primary checkout-btn">PROCCED TO
													CHECKOUT</button>
												<!-- <span class="">Checkout with multiples address!</span> -->
											</div>
										</td>
									</tr>
								</tbody><!-- /tbody -->
							</table><!-- /table -->
						</div><!-- /.cart-shopping-total -->
					</div><!-- /.shopping-cart -->
			</form>
		<?php
		endif
		?>
	</div> <!-- /.row -->

</div><!-- /.container -->
</div><!-- /.body-content -->

<!-- ============================================================= FOOTER ============================================================= -->

<?php 
include("../../inc/footer.php");
?>