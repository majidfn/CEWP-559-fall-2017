//
// Login
//

function showWelcome() {
    document.getElementById("welcome_msg").innerHTML = `Welcome, ${user}!`;
}

function showLoggedInUserMenus(){
    document.getElementById("nav_cart").style.display = 'block';
    document.getElementById("nav_login").style.display = 'none';
}

function showAdminUserMenus(){
    if(!isAdmin) return;
    document.getElementById("nav_new_item").style.display = 'block';
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
        user = response.username;

        setCookie('token', userToken, 1);
        setCookie('isAdmin', isAdmin, 1);
        setCookie('username', username, 1);

        showWelcome();
        showLoggedInUserMenus();
        showAdminUserMenus();

        showCategories();
    });
}
