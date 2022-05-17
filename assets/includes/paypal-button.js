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
        purchase_units: [{"description":"RecandleME","amount":{"currency_code":"GBP","value":30}}]
      });
    },

    onApprove: function(data, actions) {
      return actions.order.capture().then(function(orderData) {
        
        // Full available details
        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

        alert("Thank you for your purchase! You will get your order confirmation shortly");
        location.href="thank-you.php";
      });
    },

    onError: function(err) {
      console.log(err);
    }
  }).render('#paypal');
}
initPayPalButton();
