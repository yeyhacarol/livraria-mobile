'use strict'
/* 
import { loadModal } from "./modal" */

const catalogueDb = [
    {
        id: 1,
        title: 'antologia dark',
        author: 'Cesar Bravo',
        description: 'uma homenagem à obra de Stephen King e um agradecimento por suas palavras terem formado leitores e vidas. A antologia é o primeiro volume de uma coleção que vai promover a importância do conto no universo do horror e o diálogo entre autores nacionais e grandes mestres da literatura dark.',
        gender: 'ficção',
        oldPrice: 'R$ 54,90',
        newPrice: 'R$ 49,41',
        image: './img/antologia-dark.png',
    },
    {
        id: 2,
        title: 'legião',
        author: 'William Peter Blatty',
        description: 'continuação de O Exorcista. Foi adaptado para o filme O Exorcista III em 1990. Como O Exorcista, envolve possessão demoníaca.',
        gender: 'horror',
        oldPrice: '',
        newPrice: 'R$ 31,80',
        image: './img/legiao.png',
    },
    {
        id: 3,
        title: 'medicina macabra',
        author: '',
        description: '',
        gender: '',
        oldPrice: '',
        newPrice: 'R$ 43,90',
        image: './img/medicina-macabra.png',
    },
    {
        id: 4,
        title: 'vitorianas macabras',
        author: '',
        description: '',
        gender: '',
        oldPrice: 43.90,
        newPrice: 36.87,
        image: './img/vitorianas-macabras.png',
    },
    {
        id: 5,
        title: 'btk profile: máscara da maldade',
        author: '',
        description: '',
        gender: 'terror',
        oldPrice: '',
        newPrice: 53.90,
        image: './img/btk-profile.png',
    },
]

const categoriesDb = [
    {
        id: 10,
        name: 'ação',
    },
    {
        id: 20,
        name: 'biografia',
    },
]

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
                <span class="old-price" id="new-price">${product.oldPrice}</span>
                <span class="new-price">${product.newPrice}</span>
            </div>
        </div>
        <div id="see-more" data-id="${product.id}">
            <div class="details-line"></div>
            <span>ver detalhes</span>
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

document.querySelectorAll('#see-more')
    .forEach(book => book.addEventListener('click', function(event) {
        let catalogueItem = catalogueDb.filter(product => {
            return product.id == event.target.dataset.id

            
            
        })[0]
    }))

