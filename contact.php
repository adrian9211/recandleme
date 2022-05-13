<?php
# Set page title
$page_title = "Contact";
# Include header file
include('assets/includes/header.php');
?>

<!--Header section-->

<div class="container">
    <div class="row mb-5">
        <div class="col-xl-1 col-sm-1">
            <div class="header-text-left ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">
            </div>
        </div>
        <div class="col-xl-10 col-sm-10">
            <div class="header-text">
                <h1 class="text-center">CONTACT PAGE</h1>
            </div>
        </div>
        <div class="col-xl-1 col-sm-1">
            <div class="header-text-right ms-xl-4 me-xl-4 ms-sm-0 me-sm-0">

            </div>
        </div>
    </div>


<!--  Contact section-->

<div class="row ">
        <div class="col-md-6 p-0">
            <div class="about_box_dark ">
                <div class="container text_box">
                    <div class="container">
                        <div class="row mb-sm-2 mb-md-3 mb-lg-5 mt-3 ">
                            <div class="col-2">
                                <div class="col-md-3 circle ">
                                    <a href="https://www.google.com/maps" target="_blank"><i class="bi bi-geo-alt-fill fa-lg"></i></a>
                                </div>
                            </div>
                            <div class="col-10  mb-sm-2 mb-md-3 mb-lg-3">
                                <h5 class="mb-sm-2 mb-md-3 mb-lg-3">Address</h5>
                                <address class="text-muted"> 24 Milton Rd E, <br>  Edinburgh EH15 2PQ</address>
                            </div>
                        </div>
                        <div class="row mb-sm-2 mb-md-3 mb-lg-5">
                            <div class="col-2">
                                <div class="col-md-3 circle ">
                                    <a href="#" target="_blank"><i class="bi bi-telephone-fill fa-lg"></i></a>
                                </div>
                            </div>
                            <div class="col-10 ">
                                <h5 class="mb-sm-2 mb-md-3 mb-lg-3">Lets Talk</h5>
                                <a href="tel:017687 72912" class="highlated">0176546 76533</a>
                            </div>
                        </div>
                        <div class="row mb-sm-2 mb-md-3 mb-lg-5">
                            <div class="col-2">
                                <div class="col-md-3 circle ">
                                    <a href="#" target="_blank"><i class="bi bi-envelope fa-lg"></i></a>
                                </div>
                            </div>
                            <div class="col-10">
                                <h5 class="mb-sm-2 mb-md-3 mb-lg-3">General enquires</h5>
                                <a href="mailto:contact@recandleme.co.uk" class="highlated">contact@recandleme.co.uk</a>
                            </div>
                        </div>
                    </div>


                    <!--    Social media icons-->
                    <div class="container-fluid social_media social">
                        <div class="row justify-content-end mb-5 ">
                            <div class="col-md-5 gap-3 ">

                            </div>
                        </div>
                        <!--    Social media icons-->
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="video m-lg-5 m-md-4">
                            <div class="ratio ratio-21x9 ">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2234.3195003762135!2d-3.1007126840620236!3d55.94383408060492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4887b9a7365fccff%3A0x52629bc613f4b94b!2sEdinburgh%20College!5e0!3m2!1spl!2suk!4v1652186815153!5m2!1spl!2suk"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-md-6 p-0">
            <div class="about_box_white ">
                <!-- Wrapper container -->
                <div class="container contact-form py-4 mx-auto d-block">

                    <!-- Bootstrap 5 starter form -->
                    <form name="contact" method="POST" action="" //data-netlify-recaptcha="true" //data-netlify="true">
                        <h2 class="main_text text-center pt-sm-0 pt-md-1 pt-lg-2 pb-4 fs-1 mb-4">Get in touch</h2>

                        <!-- Name input -->
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input name="name" class="form-control" id="name" type="text" <?php if (isset($_POST['name'])) { echo 'value="'.$_POST['name'].'"'; } else { echo 'placeholder="Name"'; } ?> required>
                        </div>

                        <!-- Email address input -->
                        <div class="mb-3">
                            <label class="form-label" for="emailAddress">Email Address</label>
                            <input name="email" class="form-control" id="emailAddress" type="email" <?php if (isset($_POST['email'])) { echo 'value="'.$_POST['email'].'"'; } else { echo 'placeholder="Email Address"'; } ?> required>

                        </div>

                        <!-- Message input -->
                        <div class="mb-3">
                            <label class="form-label" for="message">Message</label>
                            <textarea name="message" class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" maxlength="996" required><?php if (isset($_POST['message'])) { echo $_POST['message']; } ?></textarea>
                            <!-- There is some discrepancy between the maxlength value and the mysql character count, so I've set maxlength to 996 to compensate -->
                        </div>

                        <div data-netlify-recaptcha="true"></div>


                        <!-- Form submit button -->
                        <div class="d-grid">
                            <button class="btn btn btn-secondary mt-3" type="submit">Submit</button>
                        </div>
                        <p class="text-muted mt-3">*All fields required</p>
                    </form>
            </div>
        </div>
        </div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    contactFunction();
}
?>

<!--  Contact section-->

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
