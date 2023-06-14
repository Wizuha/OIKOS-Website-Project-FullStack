function previous() {
    console.log('ok')
    const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
    document.querySelector('.slider-content').scrollLeft -= widthSlider
}

function next() { // Objectif décaler le scroll
    const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
    document.querySelector('.slider-content').scrollLeft += widthSlider
}