<?php
# Set page title
$page_title = "Thank you";
# Include header file
include('assets/includes/header.php');
?>

<?php 
    if(isset($_SESSION['cart'])) {
        unset ($_SESSION['items']); 
        unset($_SESSION['cart']); 
        if(isset($_GET['id'])) {
            echo '<script>location.href="thank-you.php?id="'.$_GET['id'].'";</script>';
        }
        else {
            echo '';
        }
    } 
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
                <h1 class="text-center">THANK YOU</h1>
            </div>
        </div>
        <div class="col-xl-1 col-sm-1">
            <div class="header-text-right ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div class="h3 m-4 p-4">Thank you for your purchase. <?php if(isset($_GET['id'])) { echo "Your order number is ".$_GET['id']. ". "; } ?>Details will be emailed to you shortly.</div>
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

<?php
# Include footer
include('assets/includes/footer.php');
?>
