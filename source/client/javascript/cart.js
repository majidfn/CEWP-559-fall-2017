//
// Cart
//

function addToCart(itemId){
    var data = {
        itemId: itemId
    }

    httpRequest('POST', '/cart', data, function (data) {
        console.log('Item Added to the Cart Successfully');
        showCart();
    });
}

function showCart() {
    hideAllSections();
    var htmlContainer = showSection('cart_container');
    htmlContainer.innerHTML = '';

    httpRequest('GET', '/cart', undefined, function (data) {

        cartItems = data.items;
        cartAmountInCents = data.total * 100;

        for (var i = 0; i < cartItems.length; i++) {
            var item = cartItems[i];
            htmlContainer.innerHTML +=
            `
            <div class="row pb-3">
                <div class="col-sm-4"><img src="${baseURL}/../images/${item['image']}" width=50 height=50 /></div>
                <div class="col-sm-4">${item['name']}</div>
                <div class="col-sm-4">$${item['price']}</div>
            </div>`;
        }
        
        htmlContainer.innerHTML += '<button type="button" id="paymentButton" class="btn btn-success btn-block">Pay Now!</button>';
        document.getElementById('paymentButton').addEventListener('click',stripeClickHandler);
    });    
}
