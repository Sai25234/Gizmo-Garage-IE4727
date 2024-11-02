
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>View Products</title>
  <link rel="stylesheet" href="css/main.css" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
      <form action="search_results.php" method="GET" class="search-bar">
        <select>
          <option name="category" value="all">BY CATEGORY</option>
          <option name="category" value="laptops">LAPTOPS</option>
          <option name="category" value="desktops">DESKTOPS</option>
          <option name="category" value="phones">PHONES</option>
          <option name="category" value="tablets">TABLETS</option>
          <option name="category" value="accessories">ACCESSORIES</option>
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
      <a href="categories.php?category=laptops"
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
  <div class="categories-container">
    <form method="GET" action="categories_filtered.php" class="filter-section">
    <?php
    include 'dbconnect.php';
    $brands = [];
    $categories = [];


    $brandQuery = "SELECT DISTINCT Brand FROM Products ORDER BY Brand ASC";
    $brandResult = $conn->query($brandQuery);
    if ($brandResult) {
        while ($row = $brandResult->fetch_assoc()) {
            $brands[] = $row['Brand'];
        }
    }

    $categoryQuery = "SELECT DISTINCT Category FROM Products ORDER BY Category ASC";
    $categoryResult = $conn->query($categoryQuery);
    if ($categoryResult) {
        while ($row = $categoryResult->fetch_assoc()) {
            $categories[] = $row['Category'];
        }
    }

    ?>
      <div id="filter-header">
        <h3>SEARCH FILTER</h3>
        <span class="material-symbols-outlined">tune</span>
      </div>
      <h4>PRODUCT CATEGORIES</h4>
      <?php foreach ($categories as $category): ?>
        <label>
            <input type="checkbox" name="category[]" value="<?php echo htmlspecialchars($category); ?>">
            <?php echo htmlspecialchars($category); ?>
        </label>
      <?php endforeach; ?>


      <h4>BRANDS</h4>
      <?php foreach ($brands as $brand): ?>
          <label>
              <input type="checkbox" name="brand[]" value="<?php echo htmlspecialchars($brand); ?>">
              <?php echo htmlspecialchars($brand); ?>
          </label>
      <?php endforeach; ?>

      <h4>SORT BY</h4>
      <label><input type="radio" name="sort" value="relevance"> Relevance</label>
      <label><input type="radio" name="sort" value="latest"> Latest</label>
      <label><input type="radio" name="sort" value="low-to-high"> Price: Low to High</label>
      <label><input type="radio" name="sort" value="high-to-low"> Price: High to Low</label>
      <input type="submit" value="Filter" id='homepage-button'></input>
    </form>

    <div class="product-grid">
      <?php 
      include 'dbconnect.php';
      
      
      $category = isset($_GET['category']) ? $_GET['category'] : 'all';
      $query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
      
      
      $sql = "SELECT * FROM Products WHERE 1=1"; 
      
      if ($category !== 'all') {
          $sql .= " AND Category = '" . mysqli_real_escape_string($conn, $category) . "'";
      }
      
      
      if (!empty($query)) {
          $sql .= " AND ProductName LIKE '%$query%'";
      }
      
      $result = $conn->query($sql);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-item">';
            echo '<a href="product_detail.php?id=' . $row['ProductID'] . '">';
            echo '<img src="' . $row['Image_url'] . '" alt="' . $row['ProductName'] . '">';
            echo '</a>';
            echo '<div class="product-item-body">';
            echo '<div class="product-item-text">';
            echo '<p class="product-name">' . $row['ProductName'] . '</p>';
            if ($row['SalePrice'] > 0){
            echo '<p class="price">$' . $row['SalePrice'] . '</p></div>';
            }
            else {
            echo '<p class="price">$' . $row['Price'] . '</p></div>';
            }
            echo "<a href='additem.php?buy=".$row['ProductID']."'><span class='material-symbols-outlined'>shopping_cart</span></a>";
            echo '</div></div>';
        }
    }
      ?>
    </div>
  </div>

  <div class="pagination">
    <a href="#">««</a>
    <a href="#" class="active">1</a>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">»»</a>
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
        <h4><u>Join Our Newsletter</u> !</h4>
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
