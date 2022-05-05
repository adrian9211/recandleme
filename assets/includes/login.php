<?php include('assets/includes/functions.php'); ?>

<?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == 0) { ?>
    <!-- Login Modal  -->
    <form method="post">
        <div class="modal" id="loginModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="input-group mb-3 input-group-sm">
                    <span class="input-group-text">Email</span>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="input-group mb-3 input-group-sm">
                    <span class="input-group-text">Password</span>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm" id="loginBtn" name='loginBtn'>Login</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
            </div>
            <div class="modal-footer">
                <span>Or <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" id="registerAnchor">Register</a> a new account</span>
            </div>

            </div>
        </div>
        </div>
    </form>
    <!-- End of Login Modal -->
<?php }
else { ?>
    <!-- Logout Modal -->
    <form method="post">
        <div class="modal" id="logoutModal">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h6 class="modal-title">Logout</h6>
                        <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure you want to log out of your current session?
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" name="logoutBtn" href="">Ok</button>
                        <a class="btn btn-danger btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Logout Modal -->
<?php } ?>

<?php if(isset($_POST['loginBtn'])) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == 0) {
        # Connect to Database
        include('assets/includes/dbaccess.php');
        $email_safe = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $pass_safe = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $query = "SELECT * FROM users WHERE email = '$email_safe' AND pass = SHA2('$pass_safe',256)";
        if($result = mysqli_query($dbc, $query)) {
            if(mysqli_num_rows($result) >= 1) {
                messageModal('You have logged in successfully!');
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $_SESSION['loggedin'] = 1;
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['admin'] = $row['admin'];
                $_SESSION['active'] = $row['active'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['email'] = $row['email'];
            }
            else {
                messageModal('User details incorrect, please try again');
            }  
        }
        else {
            messageModal('Something went wrong. Please try again, or contact us to report an error');
        }
    }
    else {
        messageModal('User already logged in.');
    }   
} ?>

<?php if(isset($_POST['logoutBtn']) && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) {
    session_unset();
    session_destroy();
    echo '<script>location.href="";</script>';
}
?>