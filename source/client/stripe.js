var handler = StripeCheckout.configure({
    key: 'pk_test_EJeN6up1FufL37mUukLr9Qgc',
    image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
    locale: 'auto',
    token: function(token) {
      console.log("token Received:", token);

      collectPayment(token.id, token.email, 2000);
      // You can access the token ID with `token.id`.
      // Get the token ID to your server-side code for use.
    }
  });
  
  function stripeClickHandler(e){
    // Open Checkout with further options:
    handler.open({
      name: 'PHP Class CEWP 559',
      description: 'E-Commerce',
      amount: cartAmountInCents
    });
    e.preventDefault();
  };
  
  // Close Checkout on page navigation:
  window.addEventListener('popstate', function() {
    handler.close();
  });