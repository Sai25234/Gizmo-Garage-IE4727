<?php
include 'dbconnect.php';
include 'session.php';
$promotions = "SELECT promotions.Category, promotions.Discount, products.Image_url, products.SalePrice 
      FROM promotions JOIN (Select Category, MIN(SalePrice) AS SalePrice FROM products GROUP BY Category) cheapest
      ON promotions.Category = cheapest.Category JOIN products ON products.Category = promotions.Category AND products.SalePrice = cheapest.SalePrice";
$promotionsresult = $conn->query($promotions);
$promotionData = [];
while ($row = $promotionsresult->fetch_assoc()) {
  $promotionData[] = $row;
}
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$streetaddress = $_POST['address'];
$postalcode = $_POST['postalcode'];
$unitcode = $_POST['unitcode'];

$cardnum = $_POST['cardnum'];
$cardexpiry = $_POST['cardexpiry'];
$cardcvv = $_POST['cardcvv'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$name = $firstName . " " . $lastName;
$address = $streetaddress . " " . $unitcode . " " . $postalcode;
$paymentdetails = $cardnum . " " . $cardexpiry . " " . $cardcvv;
$paymentdetails = md5($paymentdetails); //encrypt payment details
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gizmo Garage | Order Confirmation</title>
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
    </header>
    <div class="order-confirmation">
      <?php
      $subtotal = 0.00;
      for ($i = 0; $i < count($_SESSION['cart']['items']); $i++){
        $item = $_SESSION['cart']['items'][$i];
        $qty = $_SESSION['cart']['qty'][$item];
        $query = "SELECT * FROM Products WHERE ProductID = $item";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $price = $row['SalePrice'] ?? $row['Price'];
        $item_subtotal = $price * $qty;
        $subtotal += $item_subtotal;
      } 
      //insert checkout details
      $order = "INSERT INTO Orders (CustomerName, Email, Phone, Address, PaymentDetails, Total, Status, CreatedAt) VALUES ('$name', '$email', '$phone', '$address', '$paymentdetails', $subtotal, 'Pending', NOW())";
      $order_result = $conn->query($order);
      if ($order_result === TRUE) {
        $orderID = $conn->insert_id; //OrderID is primary key of Orders, retrieve it!!!
        //insert order items
        for ($i = 0; $i < count($_SESSION['cart']['items']); $i++){
          $item = $_SESSION['cart']['items'][$i];
          $qty = $_SESSION['cart']['qty'][$item];
          $query = "SELECT * FROM Products WHERE ProductID = $item";
          $result = $conn->query($query);
          $row = $result->fetch_assoc();
          $price = $row['SalePrice'] ?? $row['Price'];
          $orderitems = "INSERT INTO OrderItems (OrderID, ProductID, Quantity, Price) VALUES ($orderID, $item, $qty, $price)";
          $conn->query($orderitems);
        }
        //empty cart
        unset($_SESSION['cart']);
        $break = '<br>';
        //Email Confirmation
        $sql = "SELECT orders.OrderID, DATE(orders.CreatedAt) AS CreatedAt, orders.Status, orders.Total,  GROUP_CONCAT(CONCAT( '<div style=\"display: flex; align-items: center; padding-left: 0.5vw; \">','<img src=\"', SUBSTRING_INDEX(Products.Image_url, ',', 1), '\"style=\"width:80px; height:auto display:flex;\">&nbsp; ', products.ProductName, ' QTY: x', orderitems.Quantity,' PRICE: $', orderitems.Price, '</div>') SEPARATOR ' ') AS OrderItems
            FROM orders JOIN orderitems ON orders.OrderID = orderitems.OrderID 
            JOIN products ON orderitems.ProductID = products.ProductID 
            WHERE Email = '".$_SESSION['valid_user']."' AND orders.OrderID = $orderID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $to = $email;
        $subject = "Order Confirmation - Gizmo Garage";

        $message = <<<EOD
        <html>
        <head>
          <title>Order Confirmation</title>
        </head>
        <style>
        .profile-container .sidebar .action-box{
        padding: 1.5vw;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        font-size: 1.05vw;
        height: fit-content;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto auto auto;
        justify-items: center;
        width: 80%;
        border-radius: 0.5vw;
        margin-top: 2vw;
        margin-left: auto;
        margin-right: auto;
        }
        .profile-wrapper {
        margin: 2vw 0;
        justify-self: self-end;
        padding: 3vw;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        font-size: 1.05vw;
        height: fit-content;
        width: 90%;
        border-radius: 0.5vw;
        color: #01214A;}

        h1{
          text-decoration: underline;
          text-decoration-style: dashed;
          text-underline-offset: 0.2em;
        }
        h2{
          margin-top: 1vw;
          padding: 1vw 0;
        }
        table{
          width: 100%;
          border-collapse: collapse;

          tbody th{
            padding: 0.5vw 0;
            font-weight: 500;
            border: 1px solid #bbb;
          }
        }
        table tbody tr{
          align-items: center;
          justify-items: center;
          border: 1px solid #bbb;
          }

        table tbody tr td{
          
          padding: 0.5vw;
          border: 1px solid #bbb;
          justify-content: center;
          align-items: center;
        }
        </style>
        <body>
        <div class='profile-container'>
        <div class='profile-wrapper'>
          <h2>Thank you for your purchase, $name!</h2>
          <p>Your order has been successfully placed. Here are the details:</p>
        <table><tbody><tr><th>Order ID</th><th>Order Items</th><th>Order Total</th><th>Order Date</th></tr>
        <tr>
        <td>$orderID</td>
        <td> {$row['OrderItems']}</td>
        <td>{$row['Total']}</td>
        <td>{$row['CreatedAt']}</td>
        </tr>
        </tbody></table>
         
        <p>We will send you an update when your order ships. For any queries regarding your order, please reach out to us via phone or email.</p>
        <p>Thank you for shopping with us!</p><br>
            <p><strong>Phone:</strong>+65 1234 5678<br>
            <strong>Email:</strong>gizmogarage@gmail.com
        </p>
        <img src="https://github.com/Sai25234/Gizmo-Garage-IE4727/blob/master/images/gizmogaragelogo.png?raw=true" alt='Gizmo Garage' style= " height: 60px; aspect-ratio: 4;" />  
        </div>
        </div>
        </body>
        </html>
        EOD;

        $headers = 'From: Gizmo-Garage@localhost' . "\r\n" .
        'Reply-To: root@localhost' . "\r\n" .
        'X-Mailer: PHP/' . phpversion(). "\r\n" .
        'Content-type: text/html; charset=UTF-8';
       
        if(mail('root2@localhost', $subject, $message, $headers,)) {
          echo '<img src="images/Order_Confirmed_symbol.png" height="200px" width="200px"/>';
          echo '<p><strong>Order Confirmed!</strong></p>';
          echo '<p>We\'ll email you an order confirmation, along with future order status updates.</p>';
          echo '<button id="homepage-button" onclick="location.href=\'index.php\'">Return to Homepage</button>';
        }

      } else {
        echo '<p><strong>Order Failed...</strong></p>';
        echo "Error: ". $order . "<br>" . $conn->error;
      }
      
      $conn->close();
       ?>
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
        <form action="newsletter.php" method="POST" class="newsletter-form">
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
