
var baseURL = 'http://localhost/api';

var userToken = getCookie('token');
var isAdmin = getCookie('isAdmin');

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

    httpRequest.onreadystatechange = function(receivedData) {
        if (httpRequest.readyState == XMLHttpRequest.DONE && httpRequest.status == 200) {
            callback();
        }
    };    

    formData.append('new_item_image',file);
    httpRequest.send(formData);
  }

function showItems(event) {
    event.preventDefault();
    
    hideAllSections();

    var htmlContainer = document.getElementById('list_items_container');
    htmlContainer.innerHTML = '';
    htmlContainer.style.display = "inline-block";

    

    httpRequest('GET', '/items', undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            htmlContainer.innerHTML += 
                `<div class="item_box">
                    
                    <div class="center"><img src="${baseURL}/../images/${item['image']}" width=150 height=150 /></div>
                    <div class="title"><a href="#" onclick="showItem(event, ${item['id']})">${item["name"]}</a></div>
                    <div class="description">${item["description"]}</div>
                    <div class="price">$${item["price"]}</div>
                
                </div>`;
        }
    });

}

function showItem(event, id) {
    event.preventDefault();
    
    hideAllSections();
    
    var htmlContainer = document.getElementById('single_item_container');
    htmlContainer.style.display = "block";
    
    
    
    httpRequest('GET', '/items/' + id, undefined, function (data) {
        document.getElementById('single_item_name').innerHTML = data.name;
        document.getElementById('single_item_desc').innerHTML = data.description;
        document.getElementById('single_item_price').innerHTML = '$' + data.price;
    });
}


function showNewItem(event) {
    event.preventDefault();
    
    hideAllSections();

    var htmlContainer = document.getElementById('new_item_container');
    htmlContainer.style.display = "block";

    document.getElementById("new_item_title").value = '';
    document.getElementById("new_item_desc").value = '';
    document.getElementById("new_item_price").value = '';
    document.getElementById("new_item_image").value = '';
}

function createItem(event){
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

        fileUpload(`/items/${newRecord.id}/image`, file, function(){
            console.log('File uploaded successfully!');
            document.getElementById("items_btn").click();
        });
    });
}


function showLogin(event) {
    event.preventDefault();
    
    hideAllSections();

    var htmlContainer = document.getElementById('login_container');
    htmlContainer.style.display = "block";

    document.getElementById("username").value = '';
    document.getElementById("password").value = '';
}

function login(event) {
    event.preventDefault();
    
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
    });
}



function hideAllSections() {
    document.getElementById("list_items_container").style.display = "none";
    document.getElementById("single_item_container").style.display = "none";
    document.getElementById("new_item_container").style.display = "none";
    document.getElementById("login_container").style.display = "none";
}


function loaded() {
    /// Button Listeners
    document.getElementById("items_btn").addEventListener('click', showItems, false);
    document.getElementById("new_item_btn").addEventListener('click', showNewItem, false);
    document.getElementById("login_btn").addEventListener('click', showLogin, false);
    
    document.getElementById("login_btn").click();
}