'use strict'

const smoothScroll = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
}

document.getElementById('scroll-button').addEventListener('click', smoothScroll)