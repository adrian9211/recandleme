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
    include('assets/includes/dbaccess.php');
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
        messageModal('You have registered successfully!');
    }
}
?>