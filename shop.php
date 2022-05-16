<?php
# Set page title
$page_title = "Shop";
# Include header file
include('assets/includes/header.php');
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
                <h1 class="text-center">SHOP PAGE</h1>
            </div>
        </div>
        <div class="col-xl-1 col-sm-1">
            <div class="header-text-right ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">
            </div>
        </div>
    </div>

    <div class="row">
        
        <?php 
            include('../db/dbaccess.php');
            $query = "SELECT * FROM products";
            $result = mysqli_query($dbc, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if($row['stock'] > 0 && $row['visible'] != 0) {
                        echo '<div class="col shadow-sm m-1">';
                        echo '<div class="row fw-bold">'.$row['item_name'].'</div>';
                        echo '<div class="row"><img src="shop/'.$row['img_url'].'" alt="'.$row['item_desc'].'" style="width:5rem" onclick="showModal(this);"></div>';
                        echo '<div class="row">'.$row['item_desc'].'</div>';
                        echo '<div class="row">Price: &pound;'.$row['item_price'].'</div>';
                        echo '</div>';
                    }
                }
            }
            else {
                echo '<div class="h5 m-5 text-dark">There are currently no products in the shop</div>';
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

<script src="admin/js/modal.js"></script>

<?php
# Include footer
include('assets/includes/footer.php');
?>
