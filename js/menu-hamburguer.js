'use strict'

function menuHeader() {
    var nav = document.getElementById("nav-items");
    if (nav.style.display === "block") {
        nav.style.display = "none";
    } else {
        nav.style.display = "block";
    }
}

function menuGeneros() {
    var nav = document.getElementById("nav-gender");
    if (nav.style.display === "block") {
        nav.style.display = "none";
    } else {
        nav.style.display = "block";
    }
}