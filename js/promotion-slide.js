'use strict'

import { promotionsDb } from "./bd/bd.js"
import { loadModal, loadAddress } from "./modal.js"

const promotionSlider = () => {
    const promotionSlider = document.createElement('div')
    promotionSlider.setAttribute('id', 'promotion-slider-content')

    const promotionItem = promotionsDb.map(item =>
        `<div class="promotion-slider-item">
            <img src="${item.image}">
            <div class="details">
                <div class="title">
                    <span>${item.title}</span>
                </div>
                <div class="prices">
                    <span class="old-price">${item.oldPrice ? 'R$ ' + item.oldPrice : ''}</span>
                    <span class="new-price">${item.newPrice ? 'R$ ' + item.newPrice : ''}</span>
                </div>
            </div>
            <div class="see-more">
                <span data-id="${item.id}">ver detalhes</span>
            </div>
        </div>`)

    promotionSlider.innerHTML = promotionItem.join("")

    return promotionSlider
}

const loadPromotions = () => {
    const slider = document.getElementById('promotion-slider')

    slider.appendChild(promotionSlider())
}

loadPromotions(promotionsDb)

document.querySelectorAll('.see-more')
    .forEach(book => book.addEventListener('click', function (event) {

        let promotionItem = promotionsDb.filter(product => {
            return product.id == event.target.dataset.id
        })[0]

        loadModal(promotionItem)

        document.getElementById('modal').classList.add('active')
        document.getElementById('body').style.overflowY = 'hidden'

        document.getElementById('ok').addEventListener('click', loadAddress)

    }))

const gap = 16;

const slider = document.getElementById('promotion-slider'),
      content = document.getElementById('promotion-slider-content'),
      previous = document.getElementById('previous'),
      next = document.getElementById('nexting')

next.addEventListener('click', e => {
    slider.scrollBy(width + gap, 0);
    if (slider.scrollWidth !== 0) {
        previous.style.display = "flex";
    }
    if (content.scrollWidth - width - gap <= slider.scrollLeft + width) {
        next.style.display = "none";
    }
})

previous.addEventListener("click", e => {
    slider.scrollBy(-(width + gap), 0);
    if (slider.scrollLeft - width - gap <= 0) {
        previous.style.display = "none";
    }
    if (!content.scrollWidth - width - gap <= slider.scrollLeft + width) {
        next.style.display = "flex";
    }
});

let width = slider.offsetWidth;
window.addEventListener("resize", e => (width = slider.offsetWidth));
