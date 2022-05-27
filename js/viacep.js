'use strict'

const searchCep = async (cep) => {
    const url = `https://viacep.com.br/ws/${cep}/json/`
    
    const response = await fetch(url)
    
    const data = await response.json()
    
    return data
}


export { searchCep }