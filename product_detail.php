<?php
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gizmo Garage | Product Details</title>
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
          <a href="index.php"
            ><img src="images/gizmogaragelogo.png" alt="Gizmo Garage"
          /></a>
        </div>
        <form action="search_results.php" method="GET" class="search-bar">
        <select name="category">
          <option value="all">BY CATEGORY</option>
          <option value="laptops">LAPTOPS</option>
          <option value="desktops">DESKTOPS</option>
          <option value="phones">PHONES</option>
          <option value="tablets">TABLETS</option>
          <option value="accessories">ACCESSORIES</option>
        </select>
        <input type="text" name="query" placeholder="Search for a Product..." />
        <button>
          <img src="images/search_icon.png" alt="Search" height="40px" width="40px" />
        </button>
        </form>
        <div class="account-cart">
          <?php if (isset($_SESSION['valid_user'])) {
            echo "<a href='profile.php' class='account-link'><span class='material-symbols-outlined'> person </span>
            MY ACCOUNT</a>";
          } else {
            echo "<a href='login.html' class='account-link'><span class='material-symbols-outlined'> person </span>
            MY ACCOUNT</a>";
          } ?>
          <a href="cart.php" class="cart-link">
            <span class="material-symbols-outlined"> shopping_cart </span>
            CART
          </a>
        </div>
      </div>
      <nav class="nav-bar">
      <a href="categories.php?category=Laptops">LAPTOPS</a>
      <a href="categories.php?category=desktops">DESKTOPS</a>
      <a href="categories.php?category=phones">PHONES</a>
      <a href="categories.php?category=tablets">TABLETS</a>
      <a href="categories.php?category=accessories">ACCESSORIES</a>
      <a href="categories.php?sale" class="sale-link">SALE</a>
    </nav>
      <?php
        include 'dbconnect.php';

        if (isset($_GET['id'])) {
            $productID = $_GET['id'];
            
            $query = "SELECT * FROM Products WHERE ProductID = $productID";
            $result = $conn->query($query);
            if (isset($_GET['id'])) {
                $productID = $_GET['id'];
      
                $query = "SELECT * FROM Products WHERE ProductID = $productID";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            
                    echo "<div id='product-detail-container'>";
            
                    $images = explode(',', $row['Image_url']);
                    echo "<div id='image-grid'>";
                    echo "<div id='image-gallery'>";
                    
                    if (count($images) > 1) {
                      for ($i = 0; $i < count($images); $i++) {
                        echo "<img style='border: 1px solid #4c4c4c;' src='" . trim($images[$i]) . "' alt='Product Image' onclick='changeMainImage(this.src)'/>";
                      }
                      echo "</div>";
                    }
                    

                    
                    echo "<img id='main-image' src='" . trim($images[0]) . "' alt='" . $row['ProductName'] . "'  />";
                    echo "</div>";
            
                    
                    echo "<div id='text-grid'>";
                    echo "<h3 id='product-name'>" . $row['ProductName'] . "</h3>";
            
                    
                    echo "<h3 id='product-price'>";
                    if ($row['SalePrice'] > 0) {
                        echo "<span id='price'><s>$" . $row['Price'] . "</s></span>";
                        echo "<span id='sale-price'> $" . $row['SalePrice'] . "</span>";
                    } else {
                        echo "<span id='price'>$" . $row['Price'] . "</span>";
                    }
                    echo "</h3>";
            
                    $specs = explode(',', $row['Specs']);

                    echo "<ul class='product-description'>";
                    foreach ($specs as $spec) {
                      echo "<li>" . trim($spec) . "</li>";
                    }
                    echo "</ul>";
            
                    echo "<a href='additem.php?buy=".$productID."'><button id='homepage-button'>Add to Cart</button></a>";
                
                    
                    echo "<p>Category: <span id='product-category'>" . $row['Category'] . "</span></p>";
                    
                    echo "</div>";
            
                    echo "</div>";
                  }
             }   
        } 
              
        $conn->close();
        ?>
    <script>
      function changeMainImage(newSrc) {
          document.getElementById('main-image').src = newSrc;
      }
    </script>
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
          <li><a href="categories.php?category=Laptops">Laptops</a></li>
          <li><a href="categories.php?category=desktops">Desktops</a></li>
          <li><a href="categories.php?category=phones">Phones</a></li>
          <li><a href="categories.php?category=tablets">Tablets</a></li>
          <li><a href="categories.php?category=accessories">Accessories</a></li>
          <li><a href="categories.php?sale" class="sale-link">Sale</a></li>
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
          <?php
          if (isset($_SESSION['valid_user'])) {
            echo "<li><a href='profile.php'>My Account</a></li>";
            echo "<li><a href='profile.php'>Track Your Order</a></li>";
          } else {
            echo "<li><a href='login.html'>My Account</a></li>";
            echo "<li><a href='login.html'>Track Your Order</a></li>";
          }
          ?>
          <li><a href="cart.php">My Cart</a></li>
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
