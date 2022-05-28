'use strict'

import { highlightsDb } from "./bd/bd.js"

const highlightSlider = () => {
    const highlightSlider = document.createElement('div')
    highlightSlider.setAttribute('id', 'highlight-slider-content')

    const highlightItem = highlightsDb.map(item =>
        `<div class="highlight-slider-item">
            <img src="${item.url}">
            <span>${item.title}</span>
        </div>`)

    highlightSlider.innerHTML = highlightItem.join("")

    return highlightSlider
}

const loadHighlights = () => {
    const slider = document.getElementById('highlight-slider')

    slider.appendChild(highlightSlider())
}

loadHighlights(highlightsDb)

const gap = 16;

const slider = document.getElementById('highlight-slider'),
      content = document.getElementById('highlight-slider-content'),
      previous = document.getElementById('prev'),
      next = document.getElementById('next')

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

