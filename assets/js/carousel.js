const images = document.getElementsByClassName('house-img')
const slidersContent = document.getElementsByClassName('slider-content')

    Array.from(slidersContent).forEach(sliderContent => {
        function previous() {
            console.log('ok')
            const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
            sliderContent.scrollLeft -= widthSlider
        }
        function next() { // Objectif décaler le scroll
            const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
            sliderContent.scrollLeft += widthSlider
        }
    })


// function previous() {
//     console.log('ok')
//     const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
//     document.querySelector('.slider-content').scrollLeft -= widthSlider
// }

// function next() { // Objectif décaler le scroll
//     const widthSlider = document.querySelector('.house-img').offsetWidth //Récupère la largeur actuelle du slider
//     document.querySelector('.slider-content').scrollLeft += widthSlider
// }