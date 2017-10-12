


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

    httpRequest.open(method, url);
    httpRequest.setRequestHeader('Content-Type', 'application/json');

    if (payload) {
        payload = JSON.stringify(payload)
    }

    httpRequest.send(payload);
}

function showItems(event) {
    event.preventDefault();
    
    hideAllSections();

    var htmlContainer = document.getElementById('list_items_container');
    htmlContainer.innerHTML = '';
    htmlContainer.style.display = "inline-block";

    

    httpRequest('GET', 'http://localhost/api/items', undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            htmlContainer.innerHTML += 
                `<div class="item_box">
                    
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
    
    
    
    httpRequest('GET', 'http://localhost/api/items/' + id, undefined, function (data) {
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
}

function createItem(event){
    event.preventDefault();
    
    var title = document.getElementById("new_item_title").value;
    var desc = document.getElementById("new_item_desc").value;
    var price = document.getElementById("new_item_price").value;

    var data = {
        name: title,
        description: desc,
        price: price
    }

    httpRequest('POST', 'http://localhost/api/items/', data, function () {
        console.log('Successful creation of new item');
        document.getElementById("items_btn").click();
    });
}



function hideAllSections() {
    document.getElementById("list_items_container").style.display = "none";
    document.getElementById("single_item_container").style.display = "none";
    document.getElementById("new_item_container").style.display = "none";
}


function loaded() {
    /// Button Listeners
    document.getElementById("items_btn").addEventListener('click', showItems, false);
    document.getElementById("new_item_btn").addEventListener('click', showNewItem, false);
    document.getElementById("items_btn").click();
}