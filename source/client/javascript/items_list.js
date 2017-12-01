//
// Items list
//

function showItems(filter) {
    filter = filter || '';

    hideAllSections();
    var htmlContainer = showSection('list_items_container');
    htmlContainer.innerHTML = '';
    var content = '';

    httpRequest('GET', '/items?' + filter, undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            content +=
                `<div class="item_box span4">
                    <span class="row span4 center"><img src="${baseURL}/../images/${item['image']}" width=150 height=150 /></span>
                    <h3 class="pt-5"><a class="text-warning" href="#" onclick="showItem(${item['id']})">${item["name"]}</a></h3>
                    <div class="description">${item["description"]}</div>
                    <h5>$${item["price"]}</h5>
                `;
                if(isAdmin){
                    content += `
                    <div class="pt-3">
                        <i class="fa fa-pencil-square-o fa-2x" onclick="showEditItemForm(${item['id']})"></i>
                        <i class="fa fa-trash-o fa-2x" onclick="deleteItem(${item['id']})"></i>
                    </div>`;
                }

                content += '</div>';
        }
        htmlContainer.innerHTML = content;
    });
}

function search(){
    var keyword = document.getElementById('search_keyword').value;
    showItems('search=' + keyword);
}