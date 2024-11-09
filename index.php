<?php
include 'session.php';
include 'additem.php';
include 'dbconnect.php';
$promotions = "SELECT promotions.Category, promotions.Discount, products.Image_url, products.SalePrice 
      FROM promotions JOIN (Select Category, MIN(SalePrice) AS SalePrice FROM products GROUP BY Category) cheapest
      ON promotions.Category = cheapest.Category JOIN products ON products.Category = promotions.Category AND products.SalePrice = cheapest.SalePrice";
$promotionsresult = $conn->query($promotions);
$promotionData = [];
while ($row = $promotionsresult->fetch_assoc()) {
  $promotionData[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $subject = "Welcome to Gizmo Garage's Newsletter!";
        $message = <<<EOD
        <html>
        <head>
          <title>Newsletter Subscription Confirmation</title>
        </head>
        <style>

        .info-section {
          display: flex;
          flex-direction: column;
          color: #01214A;
          gap: 0px;
        }

        .info-item {
          display: flex;
          align-items: center;
        }
        body {
            font-size: 25px;
            color: #01214A;
        }

        .info-text {
          flex: 1;
          font-size: 25px;
        }

        .info-image img {
          border-radius: 8px;
        }

        h4 {
          font-size: 1.5em;
          margin-bottom: 8px;
        }

        p {
          font-size: 1em;
          line-height: 1.5;
        }
        </style>
        <body>    
        <h2>Thank you for joining Gizmo Newsletter!</h2>
        <p>Stay tuned for updates on new products, top deals, and exclusive offers from Gizmo Garage.</p>     
        <div class="info-section">
          <div class="info-item" style="gap: 20px;">
            <div class="info-image">
              <img src="https://www.courts.com.sg/media/wysiwyg/23wk07-listing-new-release-m.jpg" alt="Latest Releases" height="270px" width="400px" />
            </div>
            <div class="info-text">
                <h4>Latest Releases</h4>
                <p>Be the first to check out the newest arrivals at Gizmo Garage! Discover cutting-edge gadgets that are designed to elevate your lifestyle. From the latest laptops to the most anticipated smartphones, don’t miss out on what’s new!</p>
            </div>
          </div>
          <div class="info-item">
            <div class="info-text">
              <h4>Top Deals</h4>
              <p>Don’t let these top deals slip away! Enjoy incredible discounts on best-sellers and customer favorites. Upgrade your tech collection with amazing prices on laptops, accessories, and more, only while stocks last!</p>
            </div>
            <div class="info-image">
              <img src="https://thumbs.dreamstime.com/b/stamp-text-top-deals-inside-illustration-top-deals-109741513.jpg" alt="Top Deals" height="300px" width="300px"/>
            </div>
          </div>
          <div class="info-item" style="gap: 20px;">
            <div class="info-image">
                <img src="https://geainstitute.edu.sg/wp-content/uploads/2022/07/logov3.png" alt="Payment Methods" width="500px" style="padding-left:0 ;" />
            </div>
            <div class="info-text">
              <h4>Wide Range of Payment Methods</h4>
              <p>Shop with ease using our wide range of payment options! At Gizmo Garage, we support all major payment methods to make your experience as seamless as possible. From credit cards to digital wallets, choose the payment option that works best for you!</p>
            </div>
          </div>
        </div>
        <br><p>Best regards,<br>Gizmo Garage Team</p>
          <p style="font-size: 20px;"><strong>Phone:</strong>+65 1234 5678<br>
          <strong>Email:</strong>gizmogarage@gmail.com
        </p>
        <img src="https://github.com/Sai25234/Gizmo-Garage-IE4727/blob/master/images/gizmogaragelogo.png?raw=true" alt='Gizmo Garage' style= " height: 60px; aspect-ratio: 4;" />  
        </div>
        </body>
        </html>
        EOD;
        
        
        $headers = 'From: Gizmo-Garage@localhost' . "\r\n" .
        'Reply-To: root@localhost' . "\r\n" .
        'X-Mailer: PHP/' . phpversion(). "\r\n" .
        'Content-type: text/html; charset=UTF-8';

        
        if (mail("root2@localhost", $subject, $message, $headers)) {
            echo "<p>Thank you for subscribing! A confirmation email has been sent to $email.</p>";
        } else {
            echo "<p>Sorry, there was an issue sending your subscription confirmation. Please try again later.</p>";
        }
    }
}
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
    rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <div class="running-promo-banner">
      <div class="banner-inner">
        <div class="banner-text">Welcome to Gizmo Garage!</div>
        <?php
          foreach ($promotionData as $row) {
              echo "<div class='banner-text'>Get $row[Discount]% off on $row[Category] now!</div>";
            }
          ?>
      </div>
    </div>
    <div class="top-bar">
      <div class="logo">
        <a href="index.php"><img src="images/gizmogaragelogo.png" alt="Gizmo Garage" /></a>
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
          <span class="material-symbols-outlined">
            shopping_cart
          </span>
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
  </header>
  <div class="promotion-banner"></div>
  <div class="carousel">
    <button class="prev" onclick="prevSlide()">&#10094;</button>
    <a href="product_detail.php?id=9"><img class="active" src="images/carousel/iphone.png" alt="iPhone 16 Promotion"><a>
    <a href="product_detail.php?id=8"><img src="images/carousel/aipc.png" alt="HP Omnibook"></a>
    <a href="product_detail.php?id=21"><img src="images/carousel/Zflip.png" alt="Galaxy zflip"></a>
    <div class="carousel-indicators">
      <span class="dot active"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>
    <button class="next" onclick="nextSlide()">&#10095;</button>
  </div>
  <?php
  if (count($promotionData) > 0) {
    echo '<div class="offer-categories"><h2>Featured Offers</h2><div class="offers-container">';
    foreach ($promotionData as $row) {
      $images = explode(',', $row['Image_url']);
      echo "<div class='offer-item'><a href='categories.php?category=$row[Category]'><img src='" . trim($images[0]) . "' alt='$row[Category]'></a>";
      echo "<div class='offer-item-text-body'><h3 class='offer-name'>Get $row[Discount]% off on $row[Category] now!</h3>";
      echo "<p>from <span class='price'>$$row[SalePrice]</span></p>";
      echo "<button class='shop-now-btn' onclick=\"location.href='categories.php?category=$row[Category]'\">Shop Now</button></div></div>";
    }
    echo '</div></div>';
  }
  ?>
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
  <script>
    const images = document.querySelectorAll('.carousel img');
    const dots = document.querySelectorAll('.carousel-indicators .dot');
    let currentSlide = 0;

    function updateCarousel() {
      images.forEach((img, index) => {
        img.classList.toggle('active', index === currentSlide);
      });
      const dots = document.querySelectorAll('.carousel-indicators .dot');
      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
      });
    }


    function nextSlide() {
      currentSlide = (currentSlide + 1) % images.length;
      updateCarousel();
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + images.length) % images.length;
      updateCarousel();
    }

    setInterval(nextSlide, 7000);

    dots.forEach((dot, index) => {
      dot.onclick = () => {
        currentSlide = index;
        updateCarousel();
      };
    });
    updateCarousel();
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
        <form action="index.php" method="POST" class="newsletter-form">
          <input type="email" name="email" placeholder="Enter Email Address">
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
