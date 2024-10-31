
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/main.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <div class="running-promo-banner">Running Promotion Banner</div>
      <div class="top-bar">
        <div class="logo">
          <a href="index.html"
            ><img src="images/gizmogaragelogo.png" alt="Gizmo Garage"
          /></a>
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
            <span class="material-symbols-outlined"> person </span>
            MY ACCOUNT
          </a>
          <a href="cart.html" class="cart-link">
            <span class="material-symbols-outlined"> shopping_cart </span>
            CART
          </a>
        </div>
      </div>
      <nav class="nav-bar">
        <a href="#"
          >LAPTOPS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="#"
          >DESKTOPS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="#"
          >PHONES<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="#"
          >TABLETS<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="#"
          >ACCESSORIES<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
        <a href="#" class="sale-link"
          >SALE<span class="material-symbols-outlined">
            keyboard_arrow_down
          </span></a
        >
      </nav>
    </header>
    <?php
    @ $db = new mysqli('hostname', 'username', 'password', 'db');
    if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.';
      exit;
    }
    $query = "SELECT SUM(Quantity) AS totalQuantity FROM ShoppingCart WHERE CustomerID = :customerId";
    $result = $db->query($query);
    $row = $result->fetch_assoc()
    $totalQuantity = $row['totakQuantity'];
    if ($totalQuantity == 0) {
      
      echo '
    <div class="empty-cart" id="empty-cart">
        <p>Your shopping cart is currently empty.</p>
        <button id="homepage-button" onclick="location.href="index.html"">Return to Homepage</button>
    </div>
    ';
    } else {
      echo '
      <div class="cart-container">
      <div class="checkout-section">
        <div class="cart-wrapper">
          <div id="cart-grid">
            <div class="order-item">
              <img src="..." />
              <div class="order-item-text">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p>
              </div>
              <a href="#">
                <span class="material-symbols-outlined"> delete </span>
              </a>
            </div>
            <div class="order-item">
              <img src="..." />
              <div class="order-item-text">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p>
              </div>
              <a href="#">
                <span class="material-symbols-outlined"> delete </span>
              </a>
            </div>
            <div class="order-item">
              <img src="..." />
              <div class="order-item-text">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p>
              </div>
              <a href="#">
                <span class="material-symbols-outlined"> delete </span>
              </a>
            </div>
            <div class="order-item">
              <img src="..." />
              <div class="order-item-text">
                <p class="product-name">Product Name</p>
                <p class="price">$XXX.XX</p>
              </div>
              <a href="#">
                <span class="material-symbols-outlined"> delete </span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="order-summary-section">
        <div class="order-summary">
          <div id="price-grid">
            <h4>Subtotal</h4>
            <p class="subtotal">$XXX.XX</p>
            <h4>Shipping</h4>
            <p>$XX.XX</p>
            <hr />
            <h3>TOTAL</h3>
            <h3 class="total">$XXXX.XX</h3>
          </div>
            <button id="homepage-button" onclick="location.href="checkout.html"">
              Checkout</button>
        </div>
      </div>
    </div> ';
    }
    
    ?>    
    <footer>
      <div class="footer-container">
        <div class="footer-column">
          <h4><u>Contact Us</u></h4>
          <p>+65 1234 5678</p>
          <p>Mon - Fri 9am-6pm<br />(excl. public holidays)</p>
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
          <h4><u>My Gizmo Garage</u></h4>
          <ul>
            <li><a href="#">My Account</a></li>
            <li><a href="#">Track Your Order</a></li>
            <li><a href="#">Sustainability</a></li>
            <li><a href="#">The Gizmo Newsletter</a></li>
          </ul>
        </div>
        <div class="newsletter-column">
          <h4><u>Join Our Newsletter</u> !</h4>
          <form class="newsletter-form">
            <input type="email" placeholder="Enter Email Address" />
            <button type="submit">&#10148;</button>
          </form>
          <p>
            Stay up-to-date with the latest news, products and exclusive deals.
          </p>
          <div class="payment-methods">
            <img src="images/visa_logo.png" alt="Visa" />
            <img src="images/mastercard_logo.png" alt="MasterCard" />
            <img src="images/paynow_logo.png" alt="PayNow" />
            <img src="images/Grab_pay_logo.png" alt="GrabPay" />
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2024 A Website by Ariel & Sai</p>
      </div>
    </footer>
  </body>
</html>
