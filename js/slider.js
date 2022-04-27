'use strict'
const destaques = [
    {
        id: '1',
        url: './img/ted-bundy.png',
        titulo: 'ted bundy - um estranho ao meu lado'
    },
    {
        id: '2',
        url: './img/livro-sangue.png',
        titulo: 'livros de sangue - volume 1'
    },
    {
        id: '3',
        url: './img/frankstein.png',
        titulo: 'frankstein'
    },
]

const anterior = () => {
    const anterior = document.createElement('span')
    anterior.classList.add('slider-button')
    anterior.id = 'anterior'
    anterior.innerHTML = '&lsaquo;'

    return anterior
}

const proximo = () => {
    const proximo = document.createElement('span')
    proximo.classList.add('slider-button')
    proximo.id = 'proximo'
    proximo.innerHTML = '&rsaquo;'

    return proximo
}

const gerarSlides = () => {
    const sliderContainer = document.createElement('div')
    sliderContainer.classList.add('slider-item-container')

    const slides = destaques.map(item => `
        <div class="slider-item" id="slider-item">
            <img src="${item.url}">
            <span>${item.titulo}</span>
        </div>`)

    sliderContainer.innerHTML = slides.join("")

    return sliderContainer
}

const geraSlide = () => {
    const slider = document.querySelector('.slider')

    slider.appendChild(anterior())
    slider.appendChild(gerarSlides())
    slider.appendChild(proximo())
}

geraSlide(destaques)

const sliderItemContainer = document.querySelector('.slider-item-container')
let sliderItems = document.querySelectorAll('.slider-item')

const itemAnterior = () => {
    const ultimoItem = sliderItems[sliderItems.length - 1]

    sliderItemContainer.prepend(ultimoItem)

    sliderItems = document.querySelectorAll('.slider-item')
}

const proximoItem = () => {
    const primeiroItem = sliderItems[0]

    sliderItemContainer.appendChild(primeiroItem)

    sliderItems = document.querySelectorAll('.slider-item')
}

document.getElementById('anterior').addEventListener('click', itemAnterior)
document.getElementById('proximo').addEventListener('click', proximoItem) 