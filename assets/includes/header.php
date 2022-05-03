<!DOCTYPE html>
<html lang="en">

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

    <title><?php echo $page_title; ?></title>
</head>
<body>
<!--Navbar section-->
<nav class="navbar  navbar-expand-lg navbar-light bg-light mb-5 " id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand ms-lg-5 " href="#">
            <img  src="assets/images/icons/recandleme-logo2.png" alt="..." >
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav text-center ">
                <li class="nav-item ps-4 pe-4">
                    <!-- If the page title is 'RecandleMe', set this link as active class, and aria-current as true -->
                    <a class="nav-link<?php if ($page_title='RecandleMe') { echo ' active" aria-current="true"'; } ?> href="#home">Home</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title='') { echo ' active" aria-current="true"'; } ?> href="#shop">Shop</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title='') { echo ' active" aria-current="true"'; } ?> href="#about">About Us</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title='') { echo ' active" aria-current="true"'; } ?> href="#contact">Contact</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title='') { echo ' active" aria-current="true"'; } ?> href="#blog">Blog</a>
                </li>
                <li class="nav-item ps-4 pe-4">
                    <a class="nav-link<?php if ($page_title='') { echo ' active" aria-current="true"'; } ?> href="#more">More</a>
                </li>
            </ul>
            <button class="btn btn btn-info text-center" type="submit">Login</button>
        </div>
    </div>
</nav>
<!--Navbar section-->