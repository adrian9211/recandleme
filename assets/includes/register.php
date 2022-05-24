<!-- Register Modal  -->
<form method="post">
    <div class="modal" id="registerModal">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h5 class="modal-title">Register</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Username</span>
                <input type="text" class="form-control" name="user_name">
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">First Name</span>
                <input type="text" class="form-control" name="first_name">
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Last Name</span>
                <input type="text" class="form-control" name="last_name">
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Email</span>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Password</span>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="input-group mb-3 input-group-sm">
                <span class="input-group-text">Phone Number</span>
                <input type="text" class="form-control" name="phone">
            </div>
          </div>
    
          <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm" id="registerBtn" name="registerBtn">Register</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
        </div>
        <div class="modal-footer">
            <span>Already registered? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" id="loginAnchor">Login</a></span>
        </div>
    
        </div>
      </div>
    </div>
</form>
<!-- End of Register Modal -->

<?php if(isset($_POST['registerBtn'])) {


    # echo '<script>alert("yes");</script>';

    echo "<script>$('#alertModal').modal('show');</script>";

    # Connect to Database
    include('../db/dbaccess.php');
    # Assign variables to form input
    $user_name = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    $last_name =mysqli_real_escape_string($dbc, trim( $_POST['last_name']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $errors = [];
    // print_r($errors);
    $query = "INSERT INTO users (user_name, first_name, last_name, email, pass, phone, reg_date) VALUES ('$user_name', '$first_name', '$last_name', '$email', SHA2('$password',256), '$phone', NOW() )";
    $result = mysqli_query ($dbc, $query) ;
    if ($result) {
        # echo '<script>alert("You have registered successfully!");</script>';
        // include('assets/includes/functions.php');
        messageModal('You have registered successfully!<br>Please check your spam folder for your confirmation email');
        $q = "SELECT email_validation, admin_email from settings where id=1";
        $r = mysqli_query($dbc, $q);
        $row = mysqli_fetch_assoc($r);
        if ($row['email_validation'] == 1) {
            $admin_email = $row['admin_email'];
            $hash = uniqid('', true);
            $safeHash = $dbc->real_escape_string($hash);
            $insertQuery = "insert into emailvalidate (email, pass_key, date_created, status) "." values ('$email','$safeHash',NOW(), 'A')";
            if (!$dbc->query($insertQuery))
            {
                messageModal('An error has occured, please try again');
            }
            $urlHash = urlencode($hash);
            $to = "$email";
            $subject = "Welcome to RecandleMe!";
            $message = "
            <html>
            <head>
            <title>Welcome!</title>\r\n
            </head>
            <body>
            <p>Thank you for joining RecandleMe!</p>\r\n
            <p>Please confirm your email address by clicking the link below</p>\r\n
            <p><a href='http://localhost/recandleme/validate.php?ref=".$urlHash."'>localhost/recandleme/test.php?ref=".$urlHash."</a></p>\r\n
            <p>If the link does not work, try to copy and paste the url directly into your browser.</p>\r\n
            <p>If you did not sign up to recandleme, please ignore this email</p>\r\n
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= "From: <$admin_email>" . "\r\n";
            # $headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to,$subject,$message,$headers);


        }
    }
    else {
        messageModal('An error occurred, please try again or contact the site administrators');
    }
}
?>