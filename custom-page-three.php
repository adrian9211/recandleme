<?php
# Set page title
$page_title = "Shop";
# Include header file
include('assets/includes/header.php');

?>

<!--Header section-->

<div class="container">
    <div class="row">
        <h2 class="text-center d-flex align-items-center justify-content-center pt-5">SELECT YOUR FAVOURITE JAR</h2>
        <h6 class="text-center d-flex align-items-center justify-content-center pb-4">STEP THREE: SELECT THE JAR</h6>
    </div>
</div>
<div class="container-fluid mb-5" style="width:90%">
    <div class="row mt-4 ms-5 ps-5 mb-5">

        <?php
        include('../db/dbaccess.php');
        $query = "SELECT * FROM scents WHERE scent_type = 3";
        $result = mysqli_query($dbc, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if ($row['visible'] != 0) {
                    echo '<div class="col-lg-3 shadow-sm m-1 pt-1 pb-2 d-flex flex-column">';
                    echo '<form method="POST" id="selectItem-' . $row['scent_id'] . '" name="selectItem">';
                    echo '<input type="hidden" class="sub" name="item_id" value="' . $row['scent_id'] . '">';
                    echo '<div class="row"><img src="shop/' . $row['img_url'] . '" alt="' . strip_tags($row['description']) . '" style="width:100%" class="shopImg my-2" id="' . $row['scent_id'] . '" onclick="showModal(this);"></div>';
                    echo '<div class="row fw-bold px-3 h5">' . $row['scent_name'] . '</div>';
                    echo '<div class="row px-1 ms-2">' . $row['description'] . '</div>';
                    
                    echo '<div class="row px-1 pt-1 mt-auto"><input type="submit" name="addToCart" class="btn btn-sm bgCustomRed mt-auto" value="Select"></div>';
                    echo '</form></div>';
                }
            }
        } else {
            echo '<div class="h5 m-5 text-dark">There are currently no products in the shop</div>';
        }
        if (isset($_POST['addToCart'])) {
            $id = $_POST['item_id'];
            # echo '<script>alert("' . $id . '");</script>';
            require('../db/dbaccess.php');
            # Check product id against database 
            $q = "SELECT * FROM scents WHERE scent_id = $id";
            $r = mysqli_query($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

                # Add selection to the cart.
                $_SESSION['cust'][3] = $row['scent_name'];
                # Get custom price
                $q2 = "SELECT custom_price from settings where id = 1";
                $r2 = $dbc->query($q2);
                $row2 = $r2->fetch_assoc();
                # Add one of this product to the cart.
                $_SESSION['cart'][22] = array('quantity' => 1, 'size' => 'Custom', 'price' => $row2['custom_price']);
                if (!isset($_SESSION['items'])) {
                    $_SESSION['items'] = "1";
                } else {
                    $_SESSION['items']++;
                }
                # Close database connection.
                mysqli_close($dbc);
                echo '<script>location.href="cart.php";</script>';
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

<!-- The Modal -->
<div id="shopModal" class="modal shop-modal">
    <span class="close shop-close">&times;</span>
    <img class="modal-content shop-modal-content" id="shopImg">
    <div id="shopCaption"></div>
</div>

<script src="admin/js/functions.js"></script>
<script src="admin/js/modal.js"></script>

<?php
# Include footer
include('assets/includes/footer.php');
?>