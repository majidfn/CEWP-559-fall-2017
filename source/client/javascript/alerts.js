//
// Warnings & Alerts
//
function showWarning(text){
    document.getElementById('alert_warning').style.display = 'block';
    document.getElementById('text_error').innerHTML = text;
}

function showSuccess(text){
    document.getElementById('alert_success').style.display = 'block';
    document.getElementById('text_success').innerHTML = text;
}

function closeAlerts(){
    document.getElementById('alert_warning').style.display = 'none';
    document.getElementById('alert_success').style.display = 'none';
}
