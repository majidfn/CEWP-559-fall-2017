//
// Payment
//
function collectPayment(token, email, amount) {
    var data = {
        stripeToken: token,
        email: email,
        amount: amount
    }

    httpRequest('POST', '/payment/', data, function (response) {
        showSuccess('Payment successfully went through!');
        showCategories();
    });
}
