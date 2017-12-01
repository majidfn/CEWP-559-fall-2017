//
// Categories
//

function showCategories(event) {
    hideAllSections();
    var htmlContainer = showSection('list_categories_container');
    var content = '';

    httpRequest('GET', '/categories', undefined, function (data) {
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            content +=
                `<div class="item_box span4">
                    <span class="row span4 center"><img src="${baseURL}/../images/${item['image']}" width=150 height=150 /></span>
                    <h3 class="pt-5"><a class="text-warning" href="#" onclick="showItems('categoryid=${item['id']}')">${item["name"]}</a></h3>
                    <div class="description">${item["description"]}</div>
                `;
            // if(isAdmin){
            //     content += `
            //     <div class="pt-3">
            //         <i class="fa fa-pencil-square-o fa-2x" onclick="editCategiry(${item['id']})"></i>
            //         <i class="fa fa-trash-o fa-2x" onclick="deleteCategory(${item['id']})"></i>
            //     </div>`;
            // }
            content += '</div>';
        }
        htmlContainer.innerHTML = content;
    });
}

function newCategory(){
    
}


function createCategoriesListBox(container, id, selectedCategories){
    container.innerHTML = '';
    selectedCategories = selectedCategories || [];
    
    httpRequest('GET', '/categories/', undefined, function (data) {
        var content = `<select id="${id}" size="5" class="form-control" multiple>`;
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            selected = (selectedCategories.indexOf(item.id) != -1)? 'selected': '';
            content += `<option value="${item.id}" ${selected}>${item.name}</option>`
        }
        content += '</select>';
        document.getElementById(container).innerHTML = content;
    });
}

function getListboxSelectedValues(listboxId){
    var selectedVals = [];
    var list = document.getElementById(listboxId);
    for(var i=0; i < list.options.length; i++){
        if(list.options[i].selected){
            selectedVals.push(list.options[i].value);
        }
    }
    return selectedVals;
}
