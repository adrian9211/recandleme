<?php
# Set page title
$page_title = "Shop";
# Include header file
include('assets/includes/header.php');

?>

<!--Header section-->

<div class="shop">
    <h2 class="text-center d-flex align-items-center justify-content-center">CANDLE SCENTS</h2>
<!--    <h4 class="text-center d-flex align-items-center justify-content-center">CUSTOMIZE YOUR CHOICE</h4>-->
</div>


<div class="container scents">
    <h2 class="text-center">CANDLE SCENTS SELECTION</h2>
    <h6 class="text-center">RECANDLEME COLLECTION </h6>
    <div class="row justify-content-md-center fragrance-content ">

        <?php
        include('../db/dbaccess.php');
        $query = "SELECT * FROM sizes WHERE size_type = 'sz'";
        $result = mysqli_query($dbc, $query);
        while ($sizes = mysqli_fetch_assoc($result)) {
            $size[] = $sizes['sz_size'] . ' &pound;' . $sizes['price'];
        }
        $query2 = "SELECT * FROM products";
        $result2 = mysqli_query($dbc, $query2);
        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                if ($row['stock'] > 0 && $row['visible'] != 0) {
                    echo '<div class="col-md-3 col-sm-6 shadow-sm p-3 d-flex flex-column">';
                    echo '<form method="POST" id="selectSize-' . $row['item_id'] . '" name="selectSize">';
                    echo '<input type="hidden" class="sub" name="item_id" value="' . $row['item_id'] . '">';
                    echo '<div class="row"><img src="shop/' . $row['img_url'] . '" alt="' . strip_tags($row['item_desc']) . '" style="width:100%" class="shopImg my-2" id="' . $row['item_id'] . '" onclick="showModal(this);"></div>';
                    echo '<div class="row fw-bold px-3 h5">' . $row['item_name'] . '</div>';
                    echo '<div class="row px-1 ms-2">' . $row['item_desc'] . '</div>';
                    echo '<div class="row px-1"><select class="form-select form-select-sm" name="' . $row['item_id'] . '-size" id="' . $row['item_id'] . '-size">';
                    echo '<option value="" disabled selected>Please choose a size</option>';
                    foreach ($size as $itemsize) {
                        echo '<option value="' . $itemsize . '">' . $itemsize . '</option>';
                    }
                    echo '</select></div>';
                    echo '<div class="row px-1 pt-1"><input type="submit" name="addToCart" class="btn btn-sm bgCustomBlue mt-auto" value="Add To Cart"></div>';
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
            $q = "SELECT * FROM products WHERE item_id = $id";
            $r = mysqli_query($dbc, $q);
            if (mysqli_num_rows($r) == 1) {
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                $tmpName = $id . '-size';
                if (($_POST[$tmpName]) == '') {
                    confirmModal('Please select a size', 'shop.php?confirm=1', 'shop.php?confirm=0');
                    exit();
                }
                # Check if cart already contains one of this product id.
                if (isset($_SESSION['cart'][$id])) {
                    # check if there is enough stock
                    if ($row['stock'] > $_SESSION['cart'][$id]['quantity']) {
                        # Add one more of this product.
                        $_SESSION['cart'][$id]['quantity']++;
                        if (!isset($_SESSION['items'])) {
                            $_SESSION['items'] = "1";
                        } else {
                            $_SESSION['items']++;
                        }
                        // if (!isset($_SESSION['price'])) {
                        //     $_SESSION['price'] = floatval(number_format($_POST['tmpName']));
                        // } else {
                        //     $_SESSION['price'] += floatval(number_format($_POST['tmpName']));
                        // }
                        # Close database connection.
                        mysqli_close($dbc);
                        echo '<script>location.href="shop.php";</script>';
                    } else {
                        confirmModal('Sorry there is not enough stock', 'shop.php', 'shop.php');
                    }
                } else {
                    $sz = array();
                    $prc = array();
                    preg_match("/^[a-zA-Z]+\s/", $_POST[$tmpName], $sz);
                    preg_match("/[0-9\.]+$/", $_POST[$tmpName], $prc);
                    # Or add one of this product to the cart.
                    $_SESSION['cart'][$id] = array('quantity' => 1, 'size' => $sz[0], 'price' => $prc[0]);
                    if (!isset($_SESSION['items'])) {
                        $_SESSION['items'] = "1";
                    } else {
                        $_SESSION['items']++;
                    }
                    # Close database connection.
                    mysqli_close($dbc);
                    echo '<script>location.href="shop.php";</script>';
                }
            }
        }

        ?>

    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="h3 m-4 p-4">Want to create your own custom fragrance? <a href="custom-page-one.php" class="btn bgCustomBlue">Click Here</a></div>
        </div>
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
