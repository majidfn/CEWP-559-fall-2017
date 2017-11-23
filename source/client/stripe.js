var handler = StripeCheckout.configure({
  key: 'pk_test_EJeN6up1FufL37mUukLr9Qgc',
  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    console.log(token);
    
    var data = {
      stripeToken: token.id,
      email: token.email,
      amount: 3000
    };

     httpRequest('POST', '/payment/', data, function (response) {
        console.log('Response from server: ', response);
     });
     
  }
});

document.getElementById('customButton').addEventListener('click', function(e) {
  // Open Checkout with further options:
  handler.open({
    name: 'PHP Class',
    description: 'PHP/MySQL Rocks!',
    amount: 3000
  });
  e.preventDefault();
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});