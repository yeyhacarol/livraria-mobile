'use strict'

const smoothScroll = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    })
}

const modalExist = () => {
   if (document.getElementById('modal').hasAttribute('class')) {

       document.getElementById('scroll-button').style.display = 'none'
   }
}

document.getElementById('scroll-button').addEventListener('click', smoothScroll)
/* modalExist() */