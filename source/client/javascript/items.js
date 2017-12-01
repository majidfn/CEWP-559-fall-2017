
//
// Items Single
//

function deleteItem(id){
    var response = confirm("Are you sure you want to delete item id: " + id);
    if (response){
        httpRequest('DELETE', '/items/' + id, undefined, function (data) {
            showSuccess(`Item ID ${id}, was successfully deleted!`);
            showCategories();
        });    
    }
}

function showItem(id) {

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

function showEditItemForm(id) {
    hideAllSections();
    var htmlContainer = showSection('form_item_container');

    httpRequest('GET', '/items/' + id, undefined, function (data) {
        document.getElementById("item_id").value = data.id;
        document.getElementById("item_title").value = data.name;
        document.getElementById("item_desc").value = data.description;
        document.getElementById("item_price").value = data.price;
        document.getElementById("item_image").value = '';
        document.getElementById("item_button").innerHTML = 'Update Item!';
        document.getElementById("item_button").onclick = updateItem;
        
        createCategoriesListBox('item_categories', 'item_selected_categories', data.categories);
    });
}

function updateItem() {
    var id = document.getElementById("item_id").value;
    var title = document.getElementById("item_title").value;
    var desc = document.getElementById("item_desc").value;
    var price = document.getElementById("item_price").value;
    var categories = getListboxSelectedValues("item_selected_categories");

    var file = document.getElementById("item_image").files[0];

    var data = {
        name: title,
        description: desc,
        price: price,
        categories: categories
    }

    httpRequest('PUT', '/items/' + id, data, function (updatedRecord) {
        console.log('Successful updated existing item', updatedRecord);

        fileUpload(`/items/${updatedRecord.id}/image`, file, function () {
            console.log('File uploaded successfully!');
            showSuccess('Item Updated Successfully!');
            showCategories();
        });
    });
}


function showNewItemForm() {
    hideAllSections();
    var htmlContainer = showSection('form_item_container');

    document.getElementById("item_title").value = '';
    document.getElementById("item_desc").value = '';
    document.getElementById("item_price").value = '';
    document.getElementById("item_image").value = '';
    document.getElementById("item_button").innerHTML = 'Create New Item!';
    document.getElementById("item_button").onclick = createNewItem;

    createCategoriesListBox('item_categories', 'item_selected_categories');
}

function createNewItem() {
    var title = document.getElementById("item_title").value;
    var desc = document.getElementById("item_desc").value;
    var price = document.getElementById("item_price").value;
    var categories = getListboxSelectedValues("item_selected_categories");

    var file = document.getElementById("item_image").files[0];

    var data = {
        name: title,
        description: desc,
        price: price,
        categories: categories
    }

    httpRequest('POST', '/items/', data, function (newRecord) {
        console.log('Successful creation of new item', newRecord);

        fileUpload(`/items/${newRecord.id}/image`, file, function () {
            console.log('File uploaded successfully!');
            showSuccess('Item Created Successfully!');
            showCategories();
        });
    });
}