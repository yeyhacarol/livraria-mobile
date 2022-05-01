'use strict'

const openSearch = () => {
    var search = document.getElementById('search-area')

    if (search.style.display === 'block') {
        search.style.display = 'none'
    } else {
        search.style.display = 'block'
    }
}

document.getElementById('search').addEventListener('click', openSearch)

