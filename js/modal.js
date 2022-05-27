'use strict'

import { searchCep } from './viacep.js'

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
                <div id="calculate-freight">
                    <span>CEP</span>
                    <div class="input-cep">
                        <input type="number" id="cep" placeholder="0000000"
                            onkeypress="return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57">
                        <button id="ok">ok</button>
                    </div>
                </div>
                <div id="cep-return">
                    
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
        container.removeAttribute('class')
        document.getElementById('body').style.overflowY = 'auto'
    })
}

const loadAddress = async () => {
    const cep = document.getElementById('cep')
    const cepReturn = document.getElementById('cep-return')

    let regex = (cep) => (/^[0-9]{8}$/).test(cep)

    if(regex(cep.value.toString())) {
        const endereco = await searchCep(cep.value)

        if (endereco.erro) {
            alert('Não encontramos esse CEP na nossa base de dados.')
        } else {
            cepReturn.innerHTML = 
                `<span>${endereco.logradouro} - ${endereco.bairro} - ${endereco.uf}</span>
                 <span>Entrega em até 5 dias úteis</span>
                 <span id="change-cep">alterar cep</span>`
            
            cepReturn.classList.add('active')
            document.getElementById('calculate-freight').style.display = 'none'

            const changeCep = document.getElementById('change-cep')

            changeCep.addEventListener('click', () => {
                cepReturn.removeAttribute('class')
                document.getElementById('calculate-freight').style.display = 'block'
            })
        }
    } else {
        alert('Verifique o CEP! Não é permitido CEP com mais de 8 dígitos.')
    }
}

export {
    loadModal, loadAddress
}

