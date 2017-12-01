//
// Utilities
//
function httpRequest(method, url, payload, callback) {
    var httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function () {
        // Process the server response here.
        if (httpRequest.readyState !== XMLHttpRequest.DONE) {
            // Not ready yet
            return
        }

        if(httpRequest.status == 401) {
            showLogin();
        }
        if (httpRequest.status !== 200) {
            // alert('Something went wrong: ' + httpRequest.responseText);
            showWarning(httpRequest.responseText);
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

    formData.append('item_image', file);
    httpRequest.send(formData);
}
