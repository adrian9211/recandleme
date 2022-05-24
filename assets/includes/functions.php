<?php function messageModal($msg) { ?>
<div class="modal" id="alertModal" style="display:block">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Alert</h6>
        <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo $msg; ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom" href="">OK</a>
      </div>

    </div>
  </div>
</div>

<?php }  ?>

<?php function confirmModal($msg, $trueURL, $falseURL) { ?>
<div class="modal" style="display:block">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
          <h6 class="modal-title">Confirm</h6>
          <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
          <?php echo $msg; ?>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
          <input type="submit" class="btn btn-success btn-sm modalClose" data-bs-dismiss="modal" name="confirmBtn" onclick="location.href='<?php echo $trueURL;?>'" value="OK">
          <a class="btn btn-danger btn-sm modalClose" data-bs-dismiss="modal" id="modalCloseBottom"  onclick="location.href='<?php echo $falseURL;?>'">Cancel</a>
      </div>
      </div>
  </div>
</div>
<?php } ?>

<?php function dbClose() {
  # Close database connection.
  if (isset($dbc)) {
    $dbc->close();
  }
}

function contactFunction() {
  if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message']) && !isset($_POST)) {
    if (!isset($_POST['loginBtn']) && !isset($_POST['registerBtn'])){
      messageModal('Please fill in all the required fields');
    }
  }
  else {
    include('../db/dbaccess.php');
    $query = "select admin_email from settings where id=1";
    $result = mysqli_query($dbc, $query);
    $row = $result->fetch_assoc();

    $name_safe = mysqli_real_escape_string($dbc, $_POST['name']);
    $mail_safe = mysqli_real_escape_string($dbc, $_POST['email']);
    $msg_safe = mysqli_real_escape_string($dbc, $_POST['message']);
    # Send email
    $to = $row['admin_email'];
      $subject = "Contact from RecandleMe";
      $message = "
      <html>
      <head>
      <title>You have a new message from your contact form!</title>\r\n
      </head>
      <body>
      <p>Name: $name_safe</p>
      <p>Email: $mail_safe</p>
      <p>Message: $msg_safe</p>
      <p>". date('l jS \of F Y \a\t h:i:s A'). "</p>
      </body>
      </html>
      ";

      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= "From: <$to>" . "\r\n";
      
      $email = mail($to,$subject,$message,$headers);

      $q = "insert into messages (name, email, message, send_date) values ('$name_safe','$mail_safe','$msg_safe', NOW())";
      $r = mysqli_query($dbc, $q);
      if($r) {
        messageModal('Message sent!');
      }
  }
}

function checkout($total, $order) { ?>
<script src="https://www.paypal.com/sdk/js?client-id=AR0N9j2pD1V1e9cnUU8zOFvOAJbZLS2zGASH1NrNVL8NloUSPydWK6ORZTCCHsL5NtkJVkSmCqTSDoF_&enable-funding=venmo&currency=GBP" data-sdk-integration-source="button-factory"></script>
<script>
  function initPayPalButton() {
  paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'gold',
      layout: 'horizontal',
      label: 'checkout',
      tagline: true
    },

    createOrder: function(data, actions) {
      return actions.order.create({
        purchase_units: [{"description":"RecandleME","amount":{"currency_code":"GBP","value":<?php echo $total; ?>}}]
      });
    },

    onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData) {
        
        // Full available details
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

        alert("Thank you for your purchase! You will get your order confirmation shortly");
        location.href="thank-you.php?id=<?php echo $order; ?>";
      });
    },

    onError: function(err) {
      console.log(err);
    }
  }).render('#paypal');
}
initPayPalButton();
</script>
<div class="modal" id="alertModal" style="display:block">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title">Checkout</h6>
        <a class="btn-close modalClose" data-bs-dismiss="modal" id="modalCloseTop" href=""></a>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="bgCustomBlue text-white p-2"><span class="fw-bold">Total: </span><?php echo '&pound;'.number_format($total,2); ?></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <div id="paypal"></div>
      </div>

    </div>
  </div>
</div>

<?php }  ?>