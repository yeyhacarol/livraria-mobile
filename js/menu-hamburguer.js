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
        nav.style.display = "flex";
        nav.style.transform = "translateX(-250px)";
    } else {
        nav.style.display = "block";
        nav.style.transform = "translateX(0px)";
    }
}
