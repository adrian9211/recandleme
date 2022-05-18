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
</div>
<div class="container-fluid" style="width:80%;">
    <div class="row mt-4">
        
        <?php 
            include('../db/dbaccess.php');
            $query = "SELECT * FROM products";
            $result = mysqli_query($dbc, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if($row['stock'] > 0 && $row['visible'] != 0) {
                        
                        echo '<div class="col-lg-2 shadow-sm m-1 pt-1 pb-2 d-flex flex-column">';
                        echo '<div class="row"><img src="shop/'.$row['img_url'].'" alt="'.$row['item_desc'].'" style="width:100%" class="shopImg my-2" id="'.$row['item_id'].'" onclick="showModal(this);"></div>';
                        echo '<div class="row fw-bold px-3 h5">'.$row['item_name'].'</div>';
                        echo '<div class="row px-1 ms-2">'.$row['item_desc'].'</div>';
                        # echo '<div class="row px-3 mb-4">Price: &pound;'.$row['item_price'].'</div>';
                        echo '<select class="form-select form-select-sm mt-3"><option>Please choose a size</option><option>SMALL &pound;18.00</option><option>MEDIUM &pound;35.00</option><option>LARGE &pound;48.00</option></select>';
                        echo '<div class="row mt-auto px-1 pt-1"><button onclick="location.href=\'shop.php?item='.$row['item_id'].'\'" class="btn btn-sm bgCustomBlue">Add To Cart</button></div>';
                        echo '</div>';                        
                    }
                }
            }
            else {
                echo '<div class="h5 m-5 text-dark">There are currently no products in the shop</div>';
            }

            if(isset($_GET['item'])) {
                $id = $_GET['item'];
                require('../db/dbaccess.php');
                # Check product id against database 
                $q = "SELECT * FROM products WHERE item_id = $id" ;
                $r = mysqli_query($dbc, $q) ;
                if (mysqli_num_rows($r) == 1 )
                {
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                    if($row['stock'] > $_SESSION['cart'][$id]['quantity']){
                    # Check if cart already contains one of this product id.
                    if ( isset( $_SESSION['cart'][$id] ) )
                    {                     
                        # Add one more of this product.
                        $_SESSION['cart'][$id]['quantity']++; 
                        if (!isset($_SESSION['items'])){
                        $_SESSION['items'] = "1";  
                        } else { 
                        $_SESSION['items']++;
                        }
                        # Close database connection.
                        mysqli_close($dbc);
                        echo '<script>location.href="shop.php";</script>';
                    } 
                    else
                    {
                        # Or add one of this product to the cart.
                        $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
                        if (!isset($_SESSION['items'])){
                        $_SESSION['items'] = "1";  
                        } else { 
                        $_SESSION['items']++;
                        }
                        # Close database connection.
                        mysqli_close($dbc);
                        echo '<script>location.href="shop.php";</script>';
                    }
                    }
                    else 
                    {
                        confirmModal('Sorry there is not enough stock','shop.php?confirm=1','shop.php?confirm=0');
                        
                    }
                }
            }
            if(isset($_GET['confirm'])) {
                echo '<script>location.href="shop.php";</script>';
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

