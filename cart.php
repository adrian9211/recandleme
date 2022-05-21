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
          echo "<div class='row mb-1'> <div class='col-lg-2 bg-light fw-bold'>{$row['item_name']}</div> <div class='col-lg-5 bg-light'>{$row['item_desc']}</div>
    <div class='col-lg-3 bg-light'><input type=\"number\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\" min=\"0\" max=\"{$row['stock']}\" class=\"numInput\"></div>
    <div class='col-lg-1 bg-light'>@ {$_SESSION['price']} = </div> <div class='col-lg-1 bg-light'>" . number_format($subtotal, 2) . "</div></div>";
        }

        # Close the database connection.
        mysqli_close($dbc);

        # Display the total.
        echo ' <div class="row d-flex justify-content-end"><div class="col-lg-2 mt-2"><input type="submit" class="btn btn-warning btn-sm px-4 me-lg-5" id="update" name="update" value="UPDATE CART &#128722;"></div><div class= "col-lg-1 pt-1 mt-2 ms-lg-5 text-white bgCustomRed">Total = </div><div class="col-lg-1 mt-2 pe-1 pt-1 bgCustomRed text-white fw-bold" id="totes">' . number_format($total, 2) . '</div></div>';
        echo '</div></form>';

        if (isset($_SESSION['first_name'])) {
          $usersName = $_SESSION['first_name'];
          if (isset($_SESSION['last_name'])) {
            $usersName .= ' ' . $_SESSION['last_name'];
          }
          $usersEmail = $_SESSION['email'];
        } else {
          $usersName = "";
          $usersEmail = "";
        }
        echo '<form action="" method="POST"><div class="container mb-5">';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-5 bgCustomBlue text-white fw-bold my-2">Your details</div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-3"><label>Name</label></div><div class="col-lg-4 bg-light"><input type="text" class="form-control form-control-sm my-3" placeholder="" name="name" value="' . $usersName . '"></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-1"><label>Email</label></div><div class="col-lg-4 bg-light"><input type="text" class="form-control form-control-sm mb-3" placeholder="" name="email" value="' . $usersEmail . '"></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-1 bg-light pt-1"><label>Address</label></div><div class="col-lg-4 bg-light"><textarea class="form-control mb-3" rows="5" id="address" name="address"></textarea></div></div>';
        echo '<div class="row d-flex justify-content-end"><div class="col-lg-2 bg-light pt-1"><label>UK Postcode</label></div><div class="col-lg-3 bg-light"><input type="text" class="form-control form-control-sm mb-3" placeholder="" name="postcode"></div></div>';

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
        } else if (isset($_POST['checkout'])) {
          $errors[] = "";
          if (empty($_POST['name'])) {
            $errors[] = 'Name is required';
          }
          if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid Email address required';
          }
          if (empty($_POST['address'])) {
            $errors[] = 'Address is required';
          }
          if (empty($_POST['Postcode']) || !preg_match("/^[A-Za-z]+[0-9]+[A-Za-z]?\s*[0-9]{1}[A-Za-z]{2}$/", $_POST['postcode'])) {
            $errors[] = 'Please enter a valid UK Postcode';
          }
          if (empty($errors)) {
            # Connect to the database.
            require('../db/dbaccess.php');
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
            $address = mysqli_real_escape_string($dbc, trim($_POST['address']));
            $postcode = mysqli_real_escape_string($dbc, trim($_POST['postcode']));
            checkout($total);
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