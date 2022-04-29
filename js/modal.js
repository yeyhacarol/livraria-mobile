'use strict'

const createModal = (product) => {
    const modalCard = document.createElement('div')
    modalCard.classList.add('modal-container')
    modalCard.innerHTML = 
        `<div class="book-content">
            <div class="book">
                <div id="close-modal">X</div>
                <img src="${product.image}" alt="">
            </div>
            <div class="more-about-book">
                <div class="book-description">
                    <span class="title">${product.title}</span>
                    <span class="author">${product.author}</span>
                    <span class="description">${product.description}</span>
                </div>
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
                        <span>${product.oldPrice}</span>
                        <span>- </span>
                    </div>
                </div>
                <div class="line"></div>
                <div class="total">
                    <span>total</span>
                    <div class="value">
                        <span>${product.newPrice}</span>
                    </div>
                </div>
            </div>
        </div>`

    return modalCard
}

const loadModal = (products) => {
    const modal = document.getElementById('modal')
    const modals = products.map(createModal)

    modal.replaceChildren(...modals)
}

export { loadModal }