<?php
# Set page title
$page_title = "Cart";
# Include header file
include('assets/includes/header.php');
?>

<!-- <form method="post">
  <input type="submit" value="reset" name="reset">
</form> -->
<?php #if(isset($_POST['reset'])){
#session_unset();
#session_destroy();
#}
?>

<!--Header section-->

<div class="container">
  <div class="row">
    <div class="col-xl-1 col-sm-1">
      <div class="header-text-left ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">
      </div>
    </div>
    <div class="col-xl-10 col-sm-10">
      <div class="header-text">
        <h1 class="text-center">CART</h1>
      </div>
    </div>
    <div class="col-xl-1 col-sm-1">
      <div class="header-text-right ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">

      </div>
    </div>
  </div>
  <div class="container-fluid mt-3">
    <div class="row">

      <?php
      # Initialize grand total variable.
      $total = 0;

      # Display the cart if not empty.
      if (!empty($_SESSION['cart'])) {
        # Connect to the database.
        require('../db/dbaccess.php');
        # Retrieve all items in the cart from the 'shop' database table.
        $q = "SELECT * FROM products WHERE item_id IN (";
        foreach ($_SESSION['cart'] as $id => $value) {
          $q .= $id . ',';
        }
        $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
        $r = mysqli_query($dbc, $q);

        # Display body section with a form and a table.
        echo '<form action="cart.php" method="post"><div class="container"><div class="row"><div class="col-lg-12 text-white bgCustomBlue fw-bold mb-1">Items in your cart</div></div>';
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
          # Calculate sub-totals and grand total.
          $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
          $total += $subtotal;

          # Display the row/s:
          echo "<div class='row mb-1'> <div class='col-lg-2 bg-light fw-bold'>{$row['item_name']}</div> <div class='col-lg-5 bg-light'>";
          if(isset($_SESSION['cust'])) {
            echo $_SESSION['cust'][1].', '.$_SESSION['cust'][2].', '.$_SESSION['cust'][3];
          }
          else {
            echo $row['item_desc'];
          }
          echo "</div><div class='col-lg-2 bg-light'>";

          #{$_SESSION['cart'][$row['item_id']]['size']}
          foreach ($_SESSION['cart'][$row['item_id']] as $arrayName => $value) {
            if ($arrayName == 'size') {
              echo $arrayName . ": " . $value . "<br>";
            }
          }
          echo "</div><div class='col-lg-1 bg-light'><input type=\"number\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\" min=\"0\" max=\"{$row['stock']}\" class=\"numInput\"></div><div class='col-lg-1 bg-light'>@ {$_SESSION['cart'][$row['item_id']]['price']} = </div> <div class='col-lg-1 bg-light'>" . number_format($subtotal, 2) . "</div></div>";
        }

        # Close the database connection.
        mysqli_close($dbc);

        # Display the total.
        echo ' <div class="row d-flex justify-content-end"><div class="col-lg-2 mt-2"><input type="submit" class="btn btn-warning btn-sm px-4 me-lg-5" id="update" name="update" value="UPDATE CART &#128722;"></div><div class= "col-lg-1 pt-1 mt-2 ms-lg-5 text-white bgCustomRed">Total = </div><div class="col-lg-1 mt-2 pe-1 pt-1 bgCustomRed text-white fw-bold" id="totes">' . number_format($total, 2) . '</div></div>';
        echo '</div></form>';

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['postcode'])){
          $usersName = $_POST['name'];
          $usersEmail = $_POST['email'];
          $usersAddress = $_POST['address'];
          $usersPostcode = $_POST['postcode'];
        }
        else if (isset($_SESSION['first_name'])) {
          $usersName = $_SESSION['first_name'];
          if (isset($_SESSION['last_name'])) {
            $usersName .= ' ' . $_SESSION['last_name'];
          }
          $usersEmail = $_SESSION['email'];
          $usersPostcode = '';
        } else {
          $usersName = "";
          $usersEmail = "";
          $usersPostcode = "";
        }
        echo '<form action="" method="POST"><div class="container mb-5">';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-5 bgCustomBlue text-white fw-bold my-2">Your details</div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-3"><label>Name</label></div><div class="col-lg-4 bg-light"><input type="text" class="form-control form-control-sm my-3" placeholder="" name="name" value="' . $usersName . '"></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-1"><label>Email</label></div><div class="col-lg-4 bg-light"><input type="text" class="form-control form-control-sm mb-3" placeholder="" name="email" value="' . $usersEmail . '"></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-1"><label>Address</label></div><div class="col-lg-4 bg-light"><textarea class="form-control mb-3" rows="5" id="address" name="address"></textarea></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-2 bg-light pt-1"><label>UK Postcode</label></div><div class="col-lg-3 bg-light"><input type="text" class="form-control form-control-sm mb-3" name="postcode" value ="'.$usersPostcode.'"></div></div>';

        echo '<div class="row d-flex justify-content-end"><div class="col-lg-5 mt-2 mb-3 px-0"><div class="d-grid gap-2"><input type="submit" class="btn btn-warning btn-sm" id="checkout" name="checkout" value="CHECKOUT"></div></div></div><hr>';

        echo '<input type="hidden" name="totalSum" value="' . number_format($total, 2) . '">';
        echo '</div></form>';
      } else
      # Or display a message.
      {
        echo '<p>Your cart is currently empty.</p><a href="shop.php">Back to Shop</a>';
      }

      # Check if form has been submitted for update.
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['update'])) {

          # Set up total item count
          $items = 0;

          # Update changed quantity field values.
          foreach ($_POST['qty'] as $item_id => $item_qty) {
            # Ensure values are integers.
            $id = (int) $item_id;
            $qty = (int) $item_qty;

            # Change quantity or delete if zero.
            if ($qty == 0) {
              unset($_SESSION['cart'][$id]);
            } elseif ($qty > 0) {
              $_SESSION['cart'][$id]['quantity'] = $qty;
            }

            # Update cart total
            $items += $qty;
          }
          if ($items < 1) {
            unset($_SESSION['items']);
          } else {
            $_SESSION['items'] = $items;
          }
          echo '<script>location.href="cart.php";</script>';
        } 
        else if (isset($_POST['checkout'])) 
        {
          $errors = "";
          if (empty($_POST['name'])) {
            $errors .= 'Name is required<br>';
          }
          // if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          //   $errors .= 'Valid Email address required<br>';
          // }
          if (empty($_POST['address'])) {
            $errors .= 'Address is required<br>';
          }
          if (empty($_POST['postcode']) || !preg_match("/^[A-Za-z]+[0-9]+[A-Za-z]?\s?[0-9][A-Za-z]{2}$/", $_POST['postcode'])) {
            $errors .= 'Please enter a valid UK Postcode<br>';
          }
          if (empty($errors)) {
            # Connect to the database.
            require('../db/dbaccess.php');
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
            $address = mysqli_real_escape_string($dbc, trim($_POST['address']));
            $postcode = mysqli_real_escape_string($dbc, trim($_POST['postcode']));
            if(isset($_SESSION['user_id'])) { $userID = $_SESSION['user_id']; } else { $userID = 0; }
            # Store buyer and order total in 'orders' database table.
            $q2 = "INSERT INTO orders (user_id, username, email, address, postcode, total, order_date, paid, posted ) VALUES ( '$userID', '$name', '$email', '$address', '$postcode', '$total', NOW(), 0, 0)";
            $r2 = mysqli_query ($dbc, $q2);

            # Retrieve current order number.
            $order_id = mysqli_insert_id($dbc) ;

              # Retrieve cart items from 'shop' database table.
              $q2 = "SELECT * FROM products WHERE item_id IN (";
              foreach ($_SESSION['cart'] as $id => $value) { $q2 .= $id . ','; }
              $q2 = substr( $q2, 0, -1 ) . ') ORDER BY item_id ASC';
              $r2 = mysqli_query ($dbc, $q2);

              $itemsArray[] = "";
              # Store order contents in 'order_contents' database table.
              while ($row2 = mysqli_fetch_array ($r2, MYSQLI_ASSOC))
              {
                $item_name = $row2['item_name']." ".$_SESSION['cart'][$row2['item_id']]['size'];
                $query = "INSERT INTO order_contents ( order_id, item_id, item_name, quantity, price )
                VALUES ( $order_id, ".$row2['item_id'].", '".$item_name."', ".$_SESSION['cart'][$row2['item_id']]['quantity'].",".$_SESSION['cart'][$row2['item_id']]['price'].")" ;
                $itemsArray[] = $item_name. ' ' .$_SESSION['cart'][$row2['item_id']]['quantity']." ".$_SESSION['cart'][$row2['item_id']]['price'];
                $result = mysqli_query($dbc,$query);
              }

              $q3 = "SELECT email_validation, admin_email from settings where id=1";
              $r3 = mysqli_query($dbc, $q3);
              $row3 = mysqli_fetch_assoc($r3);
              $admin_email = $row3['admin_email'];
              $to = "$email";
              $subject = "Thank you for your order at RecandleME";
              $message = "
              <html>
              <head>
              <title>Order details</title>\r\n
              </head>
              <body>
              <p>Thank you for your purchase at RecandleMe!</p>\r\n
              <p>Order id: $order_id<p>\r\n
              <p>Order contents</p>\r\n";
              foreach($itemsArray as $item) {
                $message .= "<p>$item</p>\r\n";
              }
              $message .= "
              <p>Total: $total<p>\r\n
              <p>Please note this is not a sales receipt</p>\r\n
              <p>Kind regards</p>\r\n
              <p>RecandleME</p>\r\n
              </body>
              </html>
              ";
          
              // Always set content-type when sending HTML email
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
          
              // More headers
              $headers .= "From: <$admin_email>" . "\r\n";
              # $headers .= 'Cc: myboss@example.com' . "\r\n";
          
              mail($to,$subject,$message,$headers);
            
            checkout($total, $order_id);
          } else {
            messageModal($errors);
          }
        }
      }

      ?>
    </div>
    <!--    Folllow Us-->

    <div class="row">
      <div class="col-12 mt-4">
        <h4 class="text-center p-2 ">FOLLOW US</h4>
        <hr>
      </div>
    </div>

    <!--    Social media icons-->

    <div class="row justify-content-md-center text-center mb-4">
      <div class="col-md-auto mt-1">
        <a href="https://www.facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>
      </div>
      <div class="col-md-auto mt-1">
        <a href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
      </div>
      <div class="col-md-auto mt-1">
        <a href="https://twitter.com/" target="_blank"><i class="bi bi-youtube"></i></a>
      </div>
    </div>

    <!--    Social media icons-->

    <!--    Folllow Us-->
  </div>
</div>

<?php
# Include footer
include('assets/includes/footer.php');
?>