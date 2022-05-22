<?php 
session_start();
if($_SESSION['admin'] != 1) {
    echo '<script>location.href="../index.php";</script>';
} 
else if ($_SESSION['admin'] == 1) {
    include('../assets/includes/functions.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Panel</title>
</head>
<body class="w3-light-grey d-flex flex-column h-100">
<div class="w3-container flex-shrink-0">
    <div class="w3-bar w3-dark-gray">
        <a href="adminpanel.php" class="w3-bar-item w3-button w3-mobile px-5 mx-3">Administration Panel</a>
        <a href="adminsettings.php" class="w3-bar-item w3-button w3-mobile">Settings</a>
        <a href="admincontact.php" class="w3-bar-item w3-button w3-mobile">Contact</a>
        <a href="adminusers.php" class="w3-bar-item w3-button w3-mobile">User Management</a>
        <div class="w3-dropdown-hover w3-mobile">
            <a class="w3-button" href="adminshop.php">Shop Management <i class="fa fa-caret-down"></i></a>
            <div class="w3-dropdown-content w3-bar-block w3-dark-grey">
                <a href="adminorders.php" class="w3-bar-item w3-button w3-mobile">Orders</a>
                <a href="adminaddproduct.php" class="w3-bar-item w3-button w3-mobile">Add Product</a>
                <a href="adminmanageproducts.php" class="w3-bar-item w3-button w3-mobile">Manage Products</a>
                <a href="adminaddscent.php" class="w3-bar-item w3-button w3-mobile">Add Scent</a>
                <a href="adminmanagescents.php" class="w3-bar-item w3-button w3-mobile">Manage Scents</a>
            </div>
        </div>
        <!-- <a href="" class="w3-bar-item w3-button w3-mobile">Blog Management</a> -->
    </div>

    <div class="row">
        <div class="col-md-2">
                <div class="w3-bar-block w3-gray">
                    <div class="h6 ps-2 mt-1 pt-1">Quick Links</div>
                    <a href="../index.php" class="w3-bar-item w3-button">Homepage</a>
                    <a href="../shop.php" class="w3-bar-item w3-button">Shop</a>
                    <a href="../contact.php" class="w3-bar-item w3-button">Contact</a>
                    <a href="../blog.php" class="w3-bar-item w3-button">Blog</a>
                </div>
        </div>
        <div class="col pt-2">


