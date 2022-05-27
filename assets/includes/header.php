<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--Font import-->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;500;800&display=swap" rel="stylesheet"> <!--Font import-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/images/icons/site.webmanifest">

    <!-- jQuery CDN  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title><?php echo $page_title; ?></title>
</head>
<body class="d-flex flex-column h-100">
<!--Navbar section-->
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand ms-lg-5" href="#">
            <img src="assets/images/icons/recandleme-logo2.png" alt="..." >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav text-center ">
                <li class="nav-item ps-4 pe-4">
                    <!-- If the page title is 'RecandleMe', set this link as active class, and aria-current as true -->
                    <a class="nav-link<?php if ($page_title=='RecandleMe') { echo ' active" aria-current="true'; } echo '"'; ?> href="index.php">Home</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title=='Shop') { echo ' active" aria-current="true'; } echo '"'; ?> href="shop.php">Shop</a>
                </li>
                <?php if(isset($_SESSION['items']) && $_SESSION['items'] > 0) :?>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link" href="cart.php">Cart (<?php echo $_SESSION['items'];?>)</a>
                </li>
                <?php endif;?>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title=='About Us') { echo ' active" aria-current="true'; } echo '"'; ?> href="about.php">About Us</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title=='Contact') { echo ' active" aria-current="true'; } echo '"'; ?> href="contact.php">Contact</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title=='Blog') { echo ' active" aria-current="true'; } echo '"'; ?> href="blog.php">Blog</a>
                </li>
            </ul>
            <button class="btn btn btn-info text-center" type="button" data-bs-toggle="modal" data-bs-target="<?php if (isset($_SESSION['user_id'])){ echo '#logoutModal'; } else { echo '#loginModal'; } ?>"><?php if (isset($_SESSION['user_id'])) { echo 'Logout'; } else { echo 'Login'; } ?></button>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) : ?>
                <a class="btn btn-info text-center ms-1" type="button" href="admin/adminpanel.php" target="_blank">Admin Panel</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!--Navbar section-->
<?php include('assets/includes/functions.php'); ?>
<?php include('assets/includes/login.php'); ?>
<?php include('assets/includes/register.php'); ?>

