'use strict'

function menuHeader() {
    var nav = document.getElementById('nav-items')
    if (nav.style.display === 'block') {
        nav.style.display = 'none'
    } else {
        nav.style.display = 'block'
    }
}

function menuGeneros() {
    var nav = document.getElementById('nav-gender')
    if (nav.style.display === 'block') {
        nav.style.display = 'flex'
        nav.style.transform = 'translateX(-245px)'
    } else {
        nav.style.display = 'block'
        nav.style.transform = 'translateX(0px)'
    }
}

document.getElementById('menu-principal').addEventListener('click', menuHeader)
document.getElementById('menu-generos').addEventListener('click', menuGeneros)