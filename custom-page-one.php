<?php
# Set page title
$page_title = "Shop";
# Include header file
include('assets/includes/header.php');

?>

<!--Header section-->

<div class="custom-page-one">
    <h2 class="text-center d-flex align-items-center justify-content-center">CANDLE SCENTS</h2>
    <h6 class="text-center d-flex align-items-center justify-content-center">LUXURY SCENTS NATURALLY MADE</h6>
    <!--    <h4 class="text-center d-flex align-items-center justify-content-center">CUSTOMIZE YOUR CHOICE</h4>-->
</div>
<div class="container scents">
    <h2 class="text-center">SELECT YOUR  SCENTS</h2>
    <h6 class="text-center">STEP ONE: PICK THE FIRST SCENT  </h6>
    <div class="row justify-content-md-center fragrance-content">

        <?php
        include('../db/dbaccess.php');
        $query = "SELECT * FROM scents WHERE scent_type = 1";
        $result = mysqli_query($dbc, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if ($row['visible'] != 0) {
                    echo '<div class=" col-md-3 col-sm-6 shadow-sm pt-1 pb-2">';
                    echo '<form method="POST" id="selectItem-' . $row['scent_id'] . '" name="selectItem">';
                    echo '<input type="hidden" class="sub" name="item_id" value="' . $row['scent_id'] . '">';
                    echo '<div class="row"><img src="shop/' . $row['img_url'] . '" alt="' . strip_tags($row['description']) . '" style="width:100%" class="shopImg my-2" id="' . $row['scent_id'] . '" onclick="showModal(this);"></div>';
                    echo '<div class="row fw-bold px-3 h5">' . $row['scent_name'] . '</div>';
                    echo '<div class="row px-1 ms-2 d-flex">' . $row['description'] . '</div>';

                    echo '<div class="row px-1 pt-1 d-flex justify-content-end align-items-end"><input type="submit" name="addToCart"  class="btn btn-sm  bgCustomRed" value="Select"></div>';
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
                # Add one of this product to the cart.
                $_SESSION['cust'][1] = $row['scent_name'];
                # Close database connection.
                mysqli_close($dbc);
                echo '<script>location.href="custom-page-two.php";</script>';
            }
        }

        ?>

    </div>

    <!-- <div class="jars">
        <div class="row">
            <h2 class="text-center d-flex align-items-center justify-content-center pt-5">SELECT YOUR FAVOURITE JAR</h2>
            <h6 class="text-center d-flex align-items-center justify-content-center pb-4">STEP THREE: SELECT THE JAR AND QUANTITY </h6>
            <div class="col d-flex align-items-center justify-content-center">
                <div class="card team_photo" style="width: 25rem;">
                    <img src="/assets/images/Rectangle%2018.png" class="card-img-top" alt="Stefania profile photo">
                    <div class="card-body">
                        <h5 class="card-title text-center">Candle jar avaible in 3 sizes</h5>

                    </div>
                </div>
            </div>

            <div class="col d-flex align-items-center justify-content-center">
                <div class="card team_photo" style="width: 25rem;">
                    <img src="assets/images/Rectangle%2019.png" class="card-img-top" alt="Adrian profile photo">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Candle jar avaible in 3 sizes
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col d-flex align-items-center justify-content-center">
                <div class="card team_photo" style="width: 25rem;">
                    <img src="/assets/images/Rectangle%2017.png" class="card-img-top" alt="Luke profile photo">
                    <div class="card-body">
                        <h5 class="card-title text-center">Candle jar avaible in 3 sizes</h5>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

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
