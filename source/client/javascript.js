// 
// Main Configurations of the Applicaiton
//
var baseURL = window.location.protocol + '//' + window.location.hostname + '/api';

var userToken;
var isAdmin;
var cartAmountInCents;

var numberOfItemsPerRow = 2;

//
//
//
function httpRequest(method, url, payload, callback) {
    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function () {
        // Process the server response here.
        if (httpRequest.readyState !== XMLHttpRequest.DONE) {
            // Not ready yet
            return
        }

        if (httpRequest.status !== 200) {
            alert('Something went wrong: ' + httpRequest.responseText);
            return
        }

        callback(JSON.parse(httpRequest.responseText));
    };

    httpRequest.open(method, baseURL + url);
    httpRequest.setRequestHeader('Content-Type', 'application/json');
    httpRequest.setRequestHeader('Authorization', 'Bearer ' + userToken);

    if (payload) {
        payload = JSON.stringify(payload)
    }

    httpRequest.send(payload);
}

function fileUpload(url, file, callback) {
    var reader = new FileReader();
    var httpRequest = new XMLHttpRequest();
    var formData = new FormData();

    httpRequest.open("POST", baseURL + url);

    httpRequest.onreadystatechange = function (receivedData) {
        if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200) {
            callback();
        }
    };

    formData.append('new_item_image', file);
    httpRequest.send(formData);
}

//
// Items list
//

function showItems(event, categoryId) {
    if(event) event.preventDefault();
    var filter = categoryId? '?categoryid=' + categoryId : '';

    hideAllSections();
    var htmlContainer = showSection('list_items_container');
    htmlContainer.innerHTML = '';

    httpRequest('GET', '/items' + filter, undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            htmlContainer.innerHTML +=
                `<div class="item_box span4">
                    <span class="row span4 center"><img src="${baseURL}/../images/${item['image']}" width=150 height=150 /></span>
                    <h3 class="pt-5"><a class="text-warning" href="#" onclick="showItem(event, ${item['id']})">${item["name"]}</a></h3>
                    <div class="description">${item["description"]}</div>
                    <h5>$${item["price"]}</h5>
                </div>`;
        }
    });

}

//
// Items Single
//
function showItem(event, id) {
    event.preventDefault();

    hideAllSections();
    var htmlContainer = showSection('single_item_container');
    htmlContainer.innerHTML = '';

    httpRequest('GET', '/items/' + id, undefined, function (data) {
        htmlContainer.innerHTML += `
        <span><img src="${baseURL}/../images/${data.image}" width=200 height=200 /></span>
		<h2>${data.name}</h2>
		<h4>${data.description}</h4>
        <span>$${data.price}</span>
        <div class="row">
            <button type="button" onclick="addToCart(${data.id})" class="btn btn-success btn-block">Add to Cart</button>
        </div>
        `;
    });
}


function showNewItem(event) {
    event.preventDefault();

    hideAllSections();
    var htmlContainer = showSection('new_item_container');
    htmlContainer.innerHTML = '';

    document.getElementById("new_item_title").value = '';
    document.getElementById("new_item_desc").value = '';
    document.getElementById("new_item_price").value = '';
    document.getElementById("new_item_image").value = '';
}

function createItem(event) {
    event.preventDefault();

    var title = document.getElementById("new_item_title").value;
    var desc = document.getElementById("new_item_desc").value;
    var price = document.getElementById("new_item_price").value;

    var file = document.getElementById("new_item_image").files[0];

    var data = {
        name: title,
        description: desc,
        price: price
    }

    httpRequest('POST', '/items/', data, function (newRecord) {
        console.log('Successful creation of new item', newRecord);

        fileUpload(`/items/${newRecord.id}/image`, file, function () {
            console.log('File uploaded successfully!');
            document.getElementById("items_btn").click();
        });
    });
}

//
// Login
//

function showWelcome(username) {
    document.getElementById("welcome_msg").innerHTML = `Welcome, ${username}!`;

}

function showLogin() {
    hideAllSections();
    var htmlContainer = showSection('login_container');

    document.getElementById("username").value = '';
    document.getElementById("password").value = '';
}

function login() {
    var username = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    var data = {
        username: username,
        password: pass
    }

    httpRequest('POST', '/login/', data, function (response) {
        console.log('Successful log in: ', response);

        userToken = response.token;
        isAdmin = response.isAdmin;

        setCookie('token', userToken, 1);
        setCookie('isAdmin', isAdmin, 1);

        showWelcome(response.username);
        showCategories();
    });
}

//
// Categories
//

function showCategories(event) {
    hideAllSections();
    var htmlContainer = showSection('list_categories_container');
    htmlContainer.innerHTML = '';

    httpRequest('GET', '/categories', undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            htmlContainer.innerHTML +=
                `<div class="item_box span4">
                    <span class="row span4 center"><img src="${baseURL}/../images/${item['image']}" width=150 height=150 /></span>
                    <h3 class="pt-5"><a class="text-warning" href="#" onclick="showItems(event, ${item['id']})">${item["name"]}</a></h3>
                    <div class="description">${item["description"]}</div>
                </div>`;
        }
    });
}

//
// Cart
//

function addToCart(itemId){
    var data = {
        itemId: itemId
    }

    httpRequest('POST', '/cart', data, function (data) {
        console.log('Item Added to the Cart Successfully');
        showCategories();
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

    });
}


//
// Interacting with Cookies
//
// Helper functions to make dealing with Cookies

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


//
// Show / Hide sections of the HTML file
//



function hideAllSections() {
    document.getElementById("list_categories_container").style.display = "none";
    document.getElementById("list_items_container").style.display = "none";
    document.getElementById("single_item_container").style.display = "none";
    document.getElementById("new_item_container").style.display = "none";
    document.getElementById("login_container").style.display = "none";
    document.getElementById("cart_container").style.display = "none";
}

function showSection(sectionId) {
    var htmlContainer = document.getElementById(sectionId);
    htmlContainer.style.display = 'block';

    return htmlContainer;
}


function loaded() {
    /// Button Listeners
    // document.getElementById("items_btn").addEventListener('click', showItems, false);
    // document.getElementById("new_item_btn").addEventListener('click', showNewItem, false);
    // document.getElementById("login_btn").addEventListener('click', showLogin, false);

    // document.getElementById("login_btn").click();
}


// 
// Initializing the Application
//
var userToken = getCookie('token');
var isAdmin = getCookie('isAdmin');

hideAllSections();
showCategories();