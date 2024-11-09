<?php
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
            echo "<script>alert('Thank you for subscribing! A confirmation email has been sent to $email.');
            window.location.href= '". $_SERVER['HTTP_REFERER']. "';</script>";
        } else {
            echo "<script>alert('Sorry, there was an issue sending your subscription confirmation. Please try again later.');
            window.location.href= '". $_SERVER['HTTP_REFERER']. "';</script>";
        }
        exit();
    }
    else {
        echo "<script>alert('Invalid email address. Please try again.');
        window.location.href= '". $_SERVER['HTTP_REFERER']. "';</script>";
    }
} 
?>