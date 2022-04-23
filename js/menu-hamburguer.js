'use strict'

function menuHamburguer() {
    var nav = document.getElementById("nav-items");
    if (nav.style.display === "block") {
        nav.style.display = "none";
    } else {
        nav.style.display = "block";
        document.getElementById('line').style.display = 'none'
    }
}