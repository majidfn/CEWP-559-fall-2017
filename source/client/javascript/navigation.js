//
// Show / Hide sections of the HTML file
//



function hideAllSections() {
    document.getElementById("list_categories_container").style.display = "none";
    document.getElementById("list_items_container").style.display = "none";
    document.getElementById("single_item_container").style.display = "none";
    document.getElementById("form_item_container").style.display = "none";
    document.getElementById("login_container").style.display = "none";
    document.getElementById("cart_container").style.display = "none";
}

function showSection(sectionId) {
    var htmlContainer = document.getElementById(sectionId);
    htmlContainer.style.display = 'block';

    return htmlContainer;
}
