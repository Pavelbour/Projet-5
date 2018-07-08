setTimeout(hideAlerts, 5000);

function hideAlerts() {
    var alrt = document.getElementsByClassName('alert-success');
    var l = alrt.length;
    for (i = 0; i < l; i++) {
        alrt[i].style.display = 'none';
    }
}