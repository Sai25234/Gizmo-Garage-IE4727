<?php
include 'dbconnect.php';
include 'session.php';
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
        $to = $email;
        $subject = "Order Confirmation - Gizmo Garage";
        $message = "
        <html>
        <head>
          <title>Order Confirmation</title>
        </head>
        <body>
          <h2>Thank you for your purchase, $name!</h2>
          <p>Your order has been successfully placed. Here are the details:</p>
          <ul>
            <li><strong>Name:</strong> $name</li>
            <li><strong>Address:</strong> $address</li>
            <li><strong>Phone:</strong> $phone</li>
            <li><strong>Email:</strong> $email</li>
            <li><strong>Order Total:</strong> $subtotal</li> <!-- Replace with actual total -->
          </ul>
          <p>We will send you an update when your order ships. For any queries regarding your order, please reach out to us via phone or email. Bleow are the contact details.:</p>
          <ul>
            <li><strong>Phone:</strong>+65 1234 5678</li>
            <li><strong>Email:</strong>gizmogarage@gmail.com</li>
          </ul>
          <p>Thank you for shopping with us!</p>
        </body>
        </html>
        ";

        $headers = 'From: root@localhost' . "\r\n" .
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
          <h4><u>Join Our Newsletter</u></h4>
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
