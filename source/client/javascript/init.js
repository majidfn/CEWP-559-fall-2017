// 
// Main Configurations of the Applicaiton
//
var baseURL = window.location.protocol + '//' + window.location.hostname + '/api';

var userToken ;//= getCookie('token');
var isAdmin ;//  = getCookie('isAdmin');
var user ;// = getCookie('username');
var cartAmountInCents = 0;


// 
// Initializing the Application
//

showCategories();