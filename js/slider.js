'use strict'

import { loadModal, loadAddress } from "./modal.js"
import { highlightsDb, promotionsDb } from "./bd/bd.js"

const previousButton = () => {
    const previous = document.createElement('span')
    previous.classList.add('previous')
    previous.innerHTML = '&lsaquo;'

    return previous
}

const nextButton = () => {
    const next = document.createElement('span')
    next.classList.add('next')
    next.innerHTML = '&rsaquo;'

    return next
}

const highlightsSlider = () => {
    const highlightsItems = document.createElement('div')
    highlightsItems.classList.add('slider-container-highlights')

    const highlightsSlides = highlightsDb.map(item => `
        <div class="slider-item-highlights">
            <img src="${item.url}">
            <span>${item.title}</span>
        </div>`)

    highlightsItems.innerHTML = highlightsSlides.join("")

    return highlightsItems
}

const promotionsSlider = () => {
    const promotionsItems = document.createElement('div')
    promotionsItems.classList.add('slider-container-promotions')

    const promotionsSlides = promotionsDb.map(item => `
        <div class="slider-item-promotions">
            <img src="${item.image}">
            <div class="details">
                <div class="title">
                    <span>${item.title}</span>
                </div>
                <div class="prices">
                    <span class="old-price">${'R$ ' + item.oldPrice}</span>
                    <span class="new-price">${'R$ ' + item.newPrice}</span>
                </div>
            </div>
            <div class="see-more">
                <div class="details-line"></div>
                <span data-id="${item.id}">ver detalhes</span>
            </div>
        </div>`)

    promotionsItems.innerHTML = promotionsSlides.join("")

    return promotionsItems
}

const loadHighlights = () => {
    const slider = document.querySelector('.slider-highlights')

    slider.appendChild(previousButton())
    slider.appendChild(highlightsSlider())
    slider.appendChild(nextButton())
}
const loadPromotions = () => {
    const slider = document.querySelector('.slider-promotions')

    slider.appendChild(previousButton())
    slider.appendChild(promotionsSlider())
    slider.appendChild(nextButton())
}

loadHighlights(highlightsDb)
loadPromotions(promotionsDb)


const highlightsContainer = document.querySelector('.slider-container-highlights')
let highlights = document.querySelectorAll('.slider-item-highlights')

const promotionsContainer = document.querySelector('.slider-container-promotions')
let promotions = document.querySelectorAll('.slider-item-promotions')

const previousItem = (e) => {
    let parentElement = e.target.parentElement.children[1].children[0].className
    const highlightsLastItem = highlights[highlights.length - 1]
    const promotionsLastItem = promotions[promotions.length - 1]

    if (parentElement == 'slider-item-highlights') {
        highlightsContainer.prepend(highlightsLastItem)
        highlights = document.querySelectorAll(`.${parentElement}`)
    } else {
        promotionsContainer.prepend(promotionsLastItem)
        promotions = document.querySelectorAll(`.${parentElement}`)
    }
}

const nextItem = (e) => {
    let parentElement = e.target.parentElement.children[1].children[0].className
    const highlightsFirstItem = highlights[0]
    const promotionsFirstItem = promotions[0]

    if (parentElement == 'slider-item-highlights') {
        highlightsContainer.appendChild(highlightsFirstItem)
        highlights = document.querySelectorAll(`.${parentElement}`)
    } else {
        promotionsContainer.appendChild(promotionsFirstItem)
        promotions = document.querySelectorAll(`.${parentElement}`)
    }

}

document.querySelectorAll('.previous')
    .forEach(button => {
        button.addEventListener('click', function (e) {

            previousItem(e)
        }

)});

document.querySelectorAll('.next')
    .forEach(button => {
        button.addEventListener('click', function (e) {

            nextItem(e)
        }

)});
