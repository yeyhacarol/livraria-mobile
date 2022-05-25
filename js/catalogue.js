'use strict'

import { loadModal } from "./modal.js"
import { catalogueDb, categoriesDb } from "./bd/bd.js"

const createCard = (product) => {
    const catalogueCard = document.createElement('div')
    catalogueCard.classList.add('catalogue-item')
    catalogueCard.innerHTML =
        `<img src="${product.image}" alt="">
        <div class="details">
            <div class="title">
                <span>${product.title}</span>
            </div>
            <div class="prices">
                <span class="old-price">${product.oldPrice ? 'R$ ' + product.oldPrice : ''}</span>
                <span class="new-price">R$ ${product.newPrice ? product.newPrice : product.oldPrice}</span>
            </div>
        </div>
        <div class="see-more">
            <div class="details-line"></div>
            <span data-id="${product.id}">ver detalhes</span>
        </div>`

    return catalogueCard   
}

const loadCard = (products) => {
    const container = document.querySelector('.catalogue-container')
    const cards = products.map(createCard)

    container.replaceChildren(...cards)
}

const category = (category) => {
    const gender = document.createElement('a')
    gender.innerHTML = `${category.name}`

    return gender
}

const loadCategory = (categories) => {
    const container = document.getElementById('nav-gender')
    const genders = categories.map(category)

    container.replaceChildren(...genders)
}

loadCard(catalogueDb)
loadCategory(categoriesDb)

document.querySelectorAll('.see-more')
    .forEach(book => book.addEventListener('click', function(event) {

        let catalogueItem = catalogueDb.filter(product => {
            return product.id == event.target.dataset.id
        })[0]

        loadModal(catalogueItem)

        document.getElementById('modal').classList.add('active')
        document.getElementById('body').style.overflowY = 'hidden'
        document.getElementById('scroll-button').style.display = 'none'

    }))

export {
    catalogueDb
}