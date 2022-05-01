'use strict'

const createModal = (product) => {
    const modalCard = document.createElement('div')
    modalCard.classList.add('modal-container')
    modalCard.id = 'modal-container'
    modalCard.innerHTML =
        `<div class="book-content">
            <div class="header">
                <div class="header-content">
                    <span class="title">${product.title}</span>
                    <span class="author">${product.author}</span>
                </div>
                <div id="close-modal">X</div>
            </div>
            <div class="book">
                <img src="${product.image}" alt="">
                <span>${product.description}</span>
            </div>
        </div>
        <div class="line"></div>
        <div class="prices-content">
            <div class="freight-area">
                <span>Calcular entrega</span>
                <span>CEP</span>
                <div class="calculate-freight">
                    <input type="text">
                    <button class="ok">ok</button>
                </div>
            </div>
            <div class="book-prices">
                <div class="subtotal">
                    <span>subtotal</span>
                    <div class="value">
                        <span>${product.oldPrice ? 'R$ ' + product.oldPrice.toFixed(2) : ''}</span>
                        <span>R$ ${(product.oldPrice - product.newPrice).toFixed(2)}</span>
                    </div>
                </div>
                <div class="line"></div>
                <div class="total">
                    <span>total</span>
                    <div class="value">
                        <span>${product.newPrice ? 'R$ ' + product.newPrice.toFixed(2) : ''}</span>
                    </div>
                </div>
            </div>
        </div>`

    return modalCard
}

const loadModal = (product) => {
    const container = document.getElementById('modal')
    const modal = createModal(product)

    container.replaceChildren(modal)

    document.getElementById('close-modal').addEventListener('click', () => {
        container.classList.remove('active')
        document.getElementById('body').style.overflowY = 'auto'
    })
}

export {
    loadModal
}

