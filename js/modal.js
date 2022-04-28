const createModal = (catalogueItem) => {
    const modalCard = document.createElement('div')
    modalCard.setAttribute('id', 'modal-container')
    modalCard.innerHTML = 
    `<div id="modal">
        <div class="modal-content">
            <div class="top">
                <div class="book-gender">
                    <button id="close-button">X</button>
                    <img src="${catalogueItem.image}">
                    <span>${catalogueItem.gender}</span>
                </div>
                <div class="book-info">
                    <span>${catalogueItem.title}</span>
                    <span>${catalogueItem.author}</span>
                    <p>${catalogueItem.description}</p>
                </div>
            </div>
            <div class="line"></div>
            <div class="finish">
                <div class="freight-area">
                    <span>Calcular entrega</span>
                    <label>CEP</label>
                    <div class="input-cep">
                        <input type="search" class="search-cep">
                        <button type="submit" class="calculate-cep">ok</button>
                    </div>
                </div>
                <div class="prices">
                    <div class="subtotal">
                        <span>subtotal</span>
                        <div class="value">
                            <span>${catalogueItem.oldPrice}</span>
                        </div>
                    </div>
                    <div class="total">
                        <span>total</span>
                        <div class="value">
                            <span>${catalogueItem.newPrice}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>`

    document.getElementById('modal-content').replaceChildren(modalCard)
    document.getElementById('close-button').addEventListener('click', closeModal)
    
    return modalCard
}

const modalGenerator = () => {
    document.getElementById('modal-container').classList.toggle('active')
}

const closeModal = () => {
    document.getElementById('modal-container').classList.remove('active')
}

const findCatalogueItem = (event) => {
    createModal(catalogueItem)
    modalGenerator()
}

document.querySelectorAll('.see-more')
    .forEach(details => details.addEventListener('click', function(event)
    {
        catalogueDb.filter(catalogueItem => {
            return catalogueItem.id == event.target.dataset.id
        })
    })) 
