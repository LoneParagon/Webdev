<?php
session_start();
include('db.php');
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

if (isset($_POST['code']) && $_POST['code']!=""){
    $code = $_POST['code'];
    $result = pg_query($con,"SELECT * FROM products WHERE code='$code'");
    $row = pg_fetch_assoc($result);
    $name = $row['name'];
    $code = $row['code'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = array(
      $code=>array(
        'name'=>$name,
        'code'=>$code,
        'price'=>$price,
        'quantity'=>1,
        'image'=>$image)
    );

    if(empty($_SESSION["shopping_cart"])) {
      $_SESSION["shopping_cart"] = $cartArray;
    }else{
      $array_keys = array_keys($_SESSION["shopping_cart"]);
      if(in_array($code,$array_keys)) {
      } else {
      $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
      }

      }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Carousel -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.min.css
">
  <!-- Animate On Scroll -->
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="styles.css" />

  <title>Electronics Ecommerces</title>
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
            <a href="/" class="scroll-link">
              Electronics Ecommerce
            </a>
          </div>

          <div class="nav__menu">
            <div class="menu__top">
              <span class="nav__category">PHONE</span>
              <a href="#" class="close__toggle">
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-cross"></use>
                </svg>
              </a>
            </div>
            <ul class="nav__list">
              <li class="nav__item">
                <a href="/" class="nav__link">Home</a>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__link">Products</a>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__link">Blog</a>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__link">Contact</a>
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
            <li class="page__title"><?php
              $result = pg_query($con,"SELECT * FROM products WHERE code='$_GET[code]'");
              $row = pg_fetch_assoc($result);
              echo $row['code'];
            ?></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <main id="main">
    <div class="container">
      <!-- Products Details -->
      <section class="section product-details__section">
        <div class="product-detail__container">
          <div class="product-detail__left">
            <div class="details__container--left">
              <div class="product__pictures">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    echo "<div class='pictures__container'>
                    <img class='picture' src='images/products/iPhone/iphone$i.jpeg' id='pic$i' />
                    </div>";
                }
                ?>
              </div>
              <div class="product__picture" id="product__picture">
                <!-- <div class="rect" id="rect"></div> -->
                <div class="picture__container">
                  <img src=<?php echo $row['image']?> id="pic" />
                </div>
              </div>
              <div class="zoom" id="zoom"></div>
            </div>
            <form method="post" action="">
              <input type="hidden" name="code" value="<?php echo $row['code'] ?>" />
              <div class="product-details__btn">
                  <a href="javascript:void(0);"><button type="submit" class="product__btn buy">Add to cart</button></a>
              </div>
            </form>
          </div>

          <div class="product-detail__right">
            <div class="product-detail__content">
              <h3><?php echo $row['name']?></h3>
              <div class="price">
                <span class="new__price">$<?php echo $row['price']?>.00</span>
              </div>
              <div class="product__review">
                <div class="rating">
                  <svg>
                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                  </svg>
                  <svg>
                    <use xlink:href="./images/sprite.svg#icon-star-empty"></use>
                  </svg>
                </div>
                <a href="#" class="rating__quatity"><?php echo rand(5, 15); ?> reviews</a>
              </div>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                a doloribus iste natus et facere?
                dolor sit amet consectetur adipisicing elit. Sunt
                a doloribus iste natus et facere?
              </p>
              <div class="product__info-container">
                <ul class="product__info">
                  <li class="select">
                    <div class="select__option">
                      <label for="colors">Color</label>
                      <select name="colors" id="colors" class="select-box">
                        <option value="blue">blue</option>
                        <option value="red">red</option>
                      </select>
                    </div>
                    <div class="select__option">
                      <label for="size">Inches</label>
                      <select name="size" id="size" class="select-box">
                        <option value="6.65">6.65</option>
                        <option value="7.50">7.50</option>
                      </select>
                    </div>
                  </li>
                  <li>
                      <?php
                      $check = false;
                      foreach ($_SESSION["shopping_cart"] as $product){
                      if ($product["code"]==$_GET["code"]) {
                      echo  "<div class='input-counter'>
                      <span>Quantity:</span>
                      <form method='POST' action='./cart.php'>
											<input type='hidden' name='code' value=".$product['code']." />
											<input type='hidden' name='action' value='change' />
											<div class='input-counter'>
												<div class='input-group'>
                                                    <button type='submit' class='minus-btn btn-minus'>
                                                        <svg>
                                                            <use xlink:href='./images/sprite.svg#icon-minus'></use>
                                                        </svg>
                                                    </button>
                                                    <input class='form-control quantity counter-btn' min='1' max='9' name='quantity' value='".$product["quantity"]."' type='number' onchange='this.form.submit()'>
							    					<button type='submit' class='plus-btn btn-plus'>
                                                        <svg>
									    					<use xlink:href='./images/sprite.svg#icon-plus'></use>
                                                        </svg>
                                                    </button>
												</div>
											</div>";
                      $check = true;
                      $quantity = $product["quantity"];
                      } else {continue;};};
                      if (!$check) {
                        echo  "<div class='input-counter'>
                      <span>Quantity:</span>
											<div class='input-counter'>
												<div class='input-group'>
                                                    <button type='submit' class='minus-btn btn-minus' onclick='notInCart()'>
                                                        <svg>
                                                            <use xlink:href='./images/sprite.svg#icon-minus'></use>
                                                        </svg>
                                                    </button>
                                                    <input class='form-control quantity counter-btn' min='1' max='9' name='quantity' value='0' type='number' onclick='notInCart()'>
							    					<button type='submit' class='plus-btn btn-plus' onclick='notInCart()'>
                                                        <svg>
									    					<use xlink:href='./images/sprite.svg#icon-plus'></use>
                                                        </svg>
                                                    </button>
												</div>
											</div>";
                      };?>
										</form>
                    </div>
                  </li>

                  <li>
                    <span>Subtotal:</span>
                    <a href="#" class="new__price" id="cartCheck"><?php if ($check){echo "$".$row['price']*$quantity.".00";}
                    else {echo "$".$row['price'];};?></a>
                  </li>
                  <li>
                    <span>Brand:</span>
                    <a href="#">Whatever</a>
                  </li>
                  <li>
                    <span>Product Type:</span>
                    <a href="#">Whatever</a>
                  </li>
                  <li>
                    <span>Availability:</span>
                    <a href="#" class="in-stock">In Stock (<?php echo rand(5, 15); ?> Items)</a>
                  </li>
                </ul>
                <div class="product-info__btn">
                  <a href="#">
                    <span>
                      <svg>
                        <use xlink:href="./images/sprite.svg#icon-crop"></use>
                      </svg>
                    </span>&nbsp;
                    SIZE GUIDE
                  </a>
                  <a href="#">
                    <span>
                      <svg>
                        <use xlink:href="./images/sprite.svg#icon-truck"></use>
                      </svg>
                    </span>&nbsp;
                    SHIPPING
                  </a>
                  <a href="#">
                    <span>
                      <svg>
                        <use xlink:href="./images/sprite.svg#icon-envelope-o"></use>
                      </svg>&nbsp;
                    </span>
                    ASK ABOUT THIS PRODUCT
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="product-detail__bottom">
          <div class="title__container tabs">

            <div class="section__titles category__titles ">
              <div class="section__title detail-btn active" data-id="description">
                <span class="dot"></span>
                <h1 class="primary__title">Description</h1>
              </div>
            </div>

            <div class="section__titles">
              <div class="section__title detail-btn" data-id="reviews">
                <span class="dot"></span>
                <h1 class="primary__title">Reviews</h1>
              </div>
            </div>

            <div class="section__titles">
              <div class="section__title detail-btn" data-id="shipping">
                <span class="dot"></span>
                <h1 class="primary__title">Shipping Details</h1>
              </div>
            </div>
          </div>

          <div class="detail__content">
            <div class="content active" id="description">
              <p>Nam tempus turpis at metus scelerisque placerat nulla deumantos solicitud felis. Pellentesque diam
                dolor, elementum etos lobortis des mollis ut risus. Sedcus faucibus an sullamcorper mattis drostique des
                commodo pharetras loremos.Donec pretium egestas sapien et mollis.
              </p>
              <h2>Sample Unordered List</h2>
              <ul>
                <li>Comodous in tempor ullamcorper miaculis</li>
                <li>Pellentesque vitae neque mollis urna mattis laoreet.</li>
                <li>Divamus sit amet purus justo.</li>
                <li>Proin molestie egestas orci ac suscipit risus posuere loremous</li>
              </ul>
              <h2>Sample Ordered Lista</h2>
              <ol>
                <li>Comodous in tempor ullamcorper miaculis</li>
                <li>Pellentesque vitae neque mollis urna mattis laoreet.</li>
                <li>Divamus sit amet purus justo.</li>
                <li>Proin molestie egestas orci ac suscipit risus posuere loremous</li>
              </ol>
              <h2>Sample Paragraph Text</h2>
              <p>Praesent vestibulum congue tellus at fringilla. Curabitur vitae semper sem, eu convallis est. Cras
                felis
                nunc commodo eu convallis vitae interdum non nisl. Maecenas ac est sit amet augue pharetra convallis nec
                danos dui. Cras suscipit quam et turpis eleifend vitae malesuada magna congue. Damus id ullamcorper
                neque. Sed vitae mi a mi pretium aliquet ac sed elit. Pellentesque nulla eros accumsan quis justo at
                tincidunt lobortis denimes loremous. Suspendisse vestibulum lectus in lectus volutpat, ut dapibus purus
                pulvinar. Vestibulum sit amet auctor ipsum.</p>
            </div>
            <div class="content" id="reviews">
              <h1>Customer Reviews</h1>
              <div class="rating">
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                </svg>
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                </svg>
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                </svg>
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                </svg>
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-star-empty"></use>
                </svg>
              </div>
            </div>
            <div class="content" id="shipping">
              <h3>Returns Policy</h3>
              <p>You may return most new, unopened items within 30 days of delivery for a full refund. We'll also pay
                the return shipping costs if the return is a result of our error (you received an incorrect or defective
                item, etc.).</p>
              <p>You should expect to receive your refund within four weeks of giving your package to the return
                shipper, however, in many cases you will receive a refund more quickly. This time period includes the
                transit time for us to receive your return from the shipper (5 to 10 business days), the time it takes
                us to process your return once we receive it (3 to 5 business days), and the time it takes your bank to
                process our refund request (5 to 10 business days).
              </p>
              <p>If you need to return an item, simply login to your account, view the order using the 'Complete
                Orders' link under the My Account menu and click the Return Item(s) button. We'll notify you via
                e-mail of your refund once we've received and processed the returned item.
              </p>
              <h3>Shipping</h3>
              <p>We can ship to virtually any address in the world. Note that there are restrictions on some products,
                and some products cannot be shipped to international destinations.</p>
              <p>When you place an order, we will estimate shipping and delivery dates for you based on the
                availability of your items and the shipping options you choose. Depending on the shipping provider you
                choose, shipping date estimates may appear on the shipping quotes page.
              </p>
              <p>Please also note that the shipping rates for many items we sell are weight-based. The weight of any
                such item can be found on its detail page. To reflect the policies of the shipping companies we use, all
                weights will be rounded up to the next full pound.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Latest Products -->
      <section class="section latest__products">
        <div class="title__container">
          <div class="section__title filter-btn active" data-id="Latest Products">
            <span class="dot"></span>
            <h1 class="primary__title">Latest Products</h1>
          </div>
        </div>
        <div class="container" data-aos="fade-up" data-aos-duration="1200">
          <div class="glide" id="glide_2">
            <div class="glide__track" data-glide-el="track">
              <ul class="glide__slides latest-center">
                <?php
                include('db.php');
                $result = pg_query($con,"SELECT * FROM products");
                while($row = pg_fetch_assoc($result)){
                    echo "<li class='glide__slide'>
                            <div class='product'>
                                <div class='product__header'>
                                    <img src='".$row['image']."'>
                                </div>
                                <div class='product__footer'>
                                    <h3><a class='product_link' href='./product.php'>".$row['name']."</a></h3>
                                    <div class='rating'>";
                                        if (rand(0,100)<50)
                                            echo "<svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-empty'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-empty'></use>
                                                </svg>";
                                        else echo "<svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-full'></use>
                                                </svg>
                                                <svg>
                                            <use xlink:href='./images/sprite.svg#icon-star-empty'></use>
                                                </svg>";
                                    echo "</div>
                                    <div class='product__price'>
                                        <h4>$".$row['price']."</h4>
                                    </div>
                                    <a href='javascript:void(0);'><button type='submit' class='product__btn buy'>Add To Cart</button></a>
                                </form>
                                <ul>
                                    <li>
                                        <a data-tip='Quick View' data-place='left' href='#'>
                                            <svg>
                                                <use xlink:href='./images/sprite.svg#icon-eye'></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-tip='Add To Wishlist' data-place='left' href='#'>
                                            <svg>
                                                <use xlink:href='./images/sprite.svg#icon-heart-o'></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a data-tip='Add To Compare' data-place='left' href='#'>
                                            <svg>
                                                <use xlink:href='./images/sprite.svg#icon-loop2'></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>";}
                        pg_close($con);
                        ?>
                    </ul>
                  </div>

              </ul>
            </div>

            <div class="glide__arrows" data-glide-el="controls">
              <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-arrow-left2"></use>
                </svg>
              </button>
              <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                <svg>
                  <use xlink:href="./images/sprite.svg#icon-arrow-right2"></use>
                </svg>
              </button>
            </div>
          </div>
        </div>
      </section>
    </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>

  <!-- Animate On Scroll -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <!-- Custom JavaScript -->
  <script src="./js/products.js"></script>
  <script src="./js/index.js"></script>
  <script src="./js/slider.js"></script>
</body>

</html>