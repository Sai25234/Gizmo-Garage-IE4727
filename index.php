<?php
include 'dbconnect.php';
include 'session.php';
include 'additem.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gizmo Garage</title>
    <link rel="stylesheet" href="css/main.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="running-promo-banner">Running Promotion Banner</div>
      <div class="top-bar">
        <div class="logo">
          <a href="index.php"><img src="images/gizmogaragelogo.png" alt="Gizmo Garage" /></a>
        </div>
        <div class="search-bar">
          <select>
            <option value="all">BY CATEGORY</option>
            <option value="laptops">LAPTOPS</option>
            <option value="desktops">DESKTOPS</option>
            <option value="phones">PHONES</option>
            <option value="tablets">TABLETS</option>
            <option value="accessories">ACCESSORIES</option>
          </select>
          <input type="text" placeholder="Search for a Product..." />
          <button>
            <img
              src="images/search_icon.png"
              alt="Search"
              height="40px"
              width="40px"
            />
          </button>
        </div>
        <div class="account-cart">
          <a href="#" class="account-link">
            <span class="material-symbols-outlined">
                person
                </span>
            MY ACCOUNT
          </a>
          <a href="cart.php" class="cart-link">
            <span class="material-symbols-outlined">
                shopping_cart
                </span>
                CART
          </a>
        </div>
      </div>
      <nav class="nav-bar">
        <a href="categories.php?category=Laptops"
          >LAPTOPS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="categories.php?category=desktops"
          >DESKTOPS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="categories.php?category=phones"
          >PHONES<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="categories.php?category=tablets"
          >TABLETS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="categories.php?category=accessories"
          >ACCESSORIES<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="categories.php?sale" class="sale-link"
          >SALE<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
      </nav>
    </header>
    <div class="promotion-banner"></div>
        <div class="carousel">
            <button class="prev">&#10094;</button>
            <img src="images/iphone.png" alt="iPhone 16 Promotion">
            <button class="next">&#10095;</button>
            <div class="carousel-indicators">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
            <button class="next">&#10095;</button>
        </div>        
    </div>
    <div class="offer-categories">
      <h2>Featured Offers</h2>
      <div class="offers-container">
          <div class="offer-item">
              <img src="images/headphone.png" alt="Headphones">
              <div class="offer-item-text-body">
              <h3 class="offer-name">Get 10% off on Accessories now!</h3>
              <p>from <span class="price">$XXX.XX</span></p>
              <button class="shop-now-btn">Shop Now</button>
            </div>
          </div>
          <div class="offer-item">
              <div class="placeholder"></div>
              <div class="offer-item-text-body">
                <h3 class="offer-name">Offer Description</h3>
                <p>from <span class="price">$XXX.XX</span></p>
              <button class="shop-now-btn">Shop Now</button>
            </div>
          </div>
          <div class="offer-item">
              <div class="placeholder"></div>
              <div class="offer-item-text-body">
                <h3 class="offer-name">Offer Description</h3>
                <p>from <span class="price">$XXX.XX</span></p>
                <button class="shop-now-btn">Shop Now</button>
              </div>
          </div>
          <div class="offer-item">
              <div class="placeholder"></div>
              <div class="offer-item-text-body">
                <h3 class="offer-name">Offer Description</h3>
                <p>from <span class="price">$XXX.XX</span></p>
                <button class="shop-now-btn">Shop Now</button>
              </div>
          </div>
      </div>
    </div>
    <div class="offer-categories">
      <h2>Whats New at the Garage</h2>
      <div class="offers-container">
          <div class="new-product">
              <img src="images/laptop.png" alt="Headphones">
              <div class="new-product-text-body">
              <p class="product-name">Product Name</p>
              <p class="price">$XXX.XX</p> 
              <a href="#">
                <span class="material-symbols-outlined">
                  shopping_cart
                </span>
              </a>
            </div>
          </div>
          <div class="new-product">
              <div class="placeholder"></div>
              <div class="new-product-text-body">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p> 
                <a href="#">
                  <span class="material-symbols-outlined">
                    shopping_cart
                  </span>
                </a>
              </div>
          </div>
          <div class="new-product">
              <div class="placeholder"></div>
              <div class="new-product-text-body">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p> 
                <a href="#">
                  <span class="material-symbols-outlined">
                    shopping_cart
                  </span>
                </a>
              </div>
          </div>
          <div class="new-product">
              <div class="placeholder"></div>
              <div class="new-product-text-body">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p> 
                <a href="#">
                  <span class="material-symbols-outlined">
                    shopping_cart
                  </span>
                </a>
              </div>
          </div>
      </div>
    </div>
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4><u>Contact Us</u></h4>
                <p>+65 1234 5678</p>
                <p>Mon - Fri 9am-6pm<br>(excl. public holidays)</p>
                <p>gizmogarage@gmail.com</p>
            </div>
            <div class="footer-column">
                <h4><u>Our Products</u></h4>
                <ul>
                    <li><a href="#">Category A</a></li>
                    <li><a href="#">Category B</a></li>
                    <li><a href="#">Category C</a></li>
                    <li><a href="#">Category D</a></li>
                    <li><a href="#">Category E</a></li>
                    <li><a href="#" class="sale">Sale</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4><u>Customer Service</u></h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4><u>My Gizmo Garage</u> </h4>
                <ul>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Track Your Order</a></li>
                    <li><a href="#">Sustainability</a></li>
                    <li><a href="#">The Gizmo Newsletter</a></li>
                </ul>
            </div>
            <div class="newsletter-column">
                <h4>Join Our Newsletter!</h4>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter Email Address">
                    <button type="submit">&#10148;</button>
                </form>
                <p>Stay up-to-date with the latest news, products and exclusive deals.</p>
                <div class="payment-methods">
                    <img src="images/visa_logo.png" alt="Visa">
                    <img src="images/mastercard_logo.png" alt="MasterCard">
                    <img src="images/paynow_logo.png" alt="PayNow">
                    <img src="images/Grab_pay_logo.png" alt="GrabPay">
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 A Website by Ariel & Sai</p>
        </div>
    </footer>

</body>
</html>
