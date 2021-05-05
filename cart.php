<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
    foreach($_SESSION["shopping_cart"] as &$value){
        if($value['code'] === $_POST["code"]){
            $value['quantity'] = $_POST["quantity"];
            break;
        }   
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

    <!-- Carousel -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css" />
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.theme.min.css" />

    <!-- Animate On Scroll -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="styles.css" />

    <title>Cart</title>
</head>
<body>
    <header id="header" class="header">
        <div class="navigation">
            <div class="container">
                <nav class="nav">
                    <div class="nav__hamburger">
                        <svg>
                            <use xlink:href="./images/sprite.svg#icon-menu"></use>
                        </svg>
                    </div>

                    <div class="nav__logo">
                        <a href="./index.php" class="scroll-link">
                            Electronics Ecommerce
                        </a>
                    </div>

                    <div class="nav__menu">
                        <div class="menu__top">
                            <span class="nav__category">PHONE</span>
                            <a href="./index.php" class="close__toggle">
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-cross"></use>
                                </svg>
                            </a>
                        </div>
						<ul class="nav__list">
							<li class="nav__item">
								<a href="./index.php#header" class="nav__link scroll-link">Home</a>
							</li>
							<li class="nav__item">
								<a href="./index.php#category" class="nav__link scroll-link">Products</a>
							</li>
							<li class="nav__item">
								<a href="./index.php#news" class="nav__link scroll-link">Blog</a>
							</li>
							<li class="nav__item">
								<a href="./index.php#contact" class="nav__link scroll-link">Contact</a>
							</li>
						</ul>
                    </div>

                    <div class="nav__icons">
                        <a href="#" class="icon__item">
                            <svg class="icon__user">
                                <use xlink:href="./images/sprite.svg#icon-user"></use>
                            </svg>
                        </a>

                        <a href="#" class="icon__item">
                            <svg class="icon__search">
                                <use xlink:href="./images/sprite.svg#icon-search"></use>
                            </svg>
                        </a>

						<a href="cart.php" class="icon__item">
							<svg class="icon__cart">
								<use xlink:href="./images/sprite.svg#icon-shopping-basket"></use>
							</svg>
							<?php
								if(!empty($_SESSION["shopping_cart"])) {
								$cart_count = count(array_keys($_SESSION["shopping_cart"]));
								} else $cart_count = 0;
							?>
							<span id="cart__total"><?php echo $cart_count; ?></span>
						</a>
                    </div>
                </nav>
            </div>
        </div>

        <div class="page__title-area">
            <div class="container">
                <div class="page__title-container">
                    <ul class="page__titles">
                        <li>
                            <a href="./index.php#category">
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="page__title">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main id="main">
        <section class="section cart__area">
            <div class="container">
                <div class="responsive__cart-area">
                    <div class="cart__table table-responsive">
                        <table width="100%" class="table">
                            <thead>
                                <tr>
                                    <th>PRODUCT</th>
                                    <th>NAME</th>
                                    <th>UNIT PRICE</th>
                                    <th>QUANTITY</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
				    			<?php
									if(isset($_SESSION["shopping_cart"])){
										$total_price = 0;
								?>
								<?php		
									foreach ($_SESSION["shopping_cart"] as $product){
								?>
								<tr>
									<td class="product__thumbnail">
										<a href="./product.php?code=<?php echo $product["code"]?>">
											<img src='<?php echo $product["image"]; ?>' />
										</a>
									</td>
									<td class="product__name">
										<a href="./product.php?code=<?php echo $product["code"]?>"><?php echo $product["name"]; ?></a>
										<br /> <br />
										<small>Some info, not sure yet</small>
									</td>
									<td class="product__price">
										<div class="price">
											<span class="new__price"><?php echo "$".$product["price"]; ?></span>
										</div>
									</td>
									<td class="product__quantity">
										<form method='POST' action='/cart.php'>
											<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
											<input type='hidden' name='action' value="change" />
											<div class="input-counter">
												<div class="input-group">
                                                    <button type='submit' class='minus-btn btn-minus'>
                                                        <svg>
                                                            <use xlink:href="./images/sprite.svg#icon-minus"></use>
                                                        </svg>
                                                    </button>
                                                    <input class="form-control quantity counter-btn" min="1" max="9" name="quantity" value="<?php echo $product["quantity"] ?>" type="number" onchange="this.form.submit()">
							    					<button type='submit' class='plus-btn btn-plus'>
                                                        <svg>
									    					<use xlink:href="./images/sprite.svg#icon-plus"></use>
                                                        </svg>
                                                    </button>
												</div>
											</div>
										</form>
									</td>
									<td class="product__subtotal">
										<div class="price">
											<span class="new__price">
												<?php echo "$".$product["price"]*$product["quantity"]; ?>
											</span>
										</div>
										<a href="#" class="remove__cart-item">
											<form method='post' action=''>
												<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
												<input type='hidden' name='action' value="remove" />
												<button type='submit' class='remove'>
													<svg>
														<use xlink:href="./images/sprite.svg#icon-trash"></use>
													</svg>
												</button>
											</form>
										</a>
									</td>
								</tr>
								<?php
								$total_price += ($product["price"]*$product["quantity"]);
								}
							}
								?>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-btns">
                        <div class="continue__shopping">
                            <a href="/">Continue Shopping</a>
                        </div>
                        <div class="check__shipping">
                            <form action="php/checkout.php" method="post">
                                <input id="shipping_checkbox" type="checkbox" class="shipping_checkbox" name="shipping">
                                <span>Shipping(+7$)</span>
                            </div>
                    </div>

                    <div class="cart__totals">
                        <h3>Cart Totals</h3>
                        <ul>
                            <li>
                                Subtotal
                                <span class="new__price">
                                    <?php
                                    if (isset($total_price)){ 
                                        echo "$".$total_price;
                                    } else {
                                        echo "$0"; 
                                        $total_price=0;
                                    };
                                    ?>
                                </span>
                            </li>
                            <li>
                                Shipping
                                <span class="shipping_text">$0</span>
                            </li>
                            <li>
                                Total
                                <span class="new__price total_ship"><?php echo "$".$total_price; ?></span>
                            </li>
                        </ul>
                        <input type="email" placeholder="Enter your email address" id="checkout_email" class="checkout__btn" name="checkout__btn" required>
                        <input type="submit" class="checkout__link" href="" value="Checkout"></input>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Facility Section -->
        <section class="facility__section section" id="facility">
            <div class="container">
                <div class="facility__contianer">
                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="./images/sprite.svg#icon-airplane"></use>
                            </svg>
                        </div>
                        <p>FREE SHIPPING WORLD WIDE</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="./images/sprite.svg#icon-credit-card-alt"></use>
                            </svg>
                        </div>
                        <p>100% MONEY BACK GUARANTEE</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="./images/sprite.svg#icon-credit-card"></use>
                            </svg>
                        </div>
                        <p>MANY PAYMENT GATEWAYS</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="./images/sprite.svg#icon-headphones"></use>
                            </svg>
                        </div>
                        <p>24/7 ONLINE SUPPORT</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="footer" class="section footer">
        <div class="container">
            <div class="footer__top">
                <div class="footer-top__box">
                    <h3>EXTRAS</h3>
                    <a href="#">Brands</a>
                    <a href="#">Gift Certificates</a>
                    <a href="#">Affiliate</a>
                    <a href="#">Specials</a>
                    <a href="#">Site Map</a>
                </div>
                <div class="footer-top__box">
                    <h3>INFORMATION</h3>
                    <a href="#">About Us</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Contact Us</a>
                    <a href="#">Site Map</a>
                </div>
                <div class="footer-top__box">
                    <h3>MY ACCOUNT</h3>
                    <a href="#">My Account</a>
                    <a href="#">Order History</a>
                    <a href="#">Wish List</a>
                    <a href="#">Newsletter</a>
                    <a href="#">Returns</a>
                </div>
				<div class="footer-top__box">
					<h3>CONTACT US</h3>
					<div>
						<span>
							<svg>
								<use xlink:href="./images/sprite.svg#icon-location"></use>
							</svg>
						</span>
						15 Zaiceva street, Kazan, Russia
					</div>
					<div>
						<span>
						<svg>
							<use xlink:href="./images/sprite.svg#icon-envelop"></use>
						</svg>
						</span>
						gubaidullin.b29@outlook.com
					</div>
					<div>
						<span>
						<svg>
							<use xlink:href="./images/sprite.svg#icon-phone"></use>
						</svg>
						</span>
						927-435-20-86
					</div>
					<div>
						<span>
						<svg>
							<use xlink:href="./images/sprite.svg#icon-paperplane"></use>
						</svg>
						</span>
						Kazan, Russia
					</div>
					</div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer-bottom__box">

            </div>
            <div class="footer-bottom__box">

            </div>
        </div>
        </div>
    </footer>

    <!-- End Footer -->

    <!-- Go To -->

    <a href="#header" class="goto-top scroll-link">
        <svg>
            <use xlink:href="./images/sprite.svg#icon-arrow-up"></use>
        </svg>
    </a>

    <!-- Glide Carousel Script -->
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>

    <!-- Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="./js/products.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/slider.js"></script>
</body>

</html>
