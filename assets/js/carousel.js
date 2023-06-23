const houseImages = document.querySelectorAll('.house-img');
    houseImages.forEach((houseImage) => {
        const sliderContent = houseImage.querySelector('.slider-content')
        const sliderContentid = sliderContent.id
        // const sliderContent = document.querySelector(#${houseImgId} .slider-content);


        houseImage.querySelector('.arrow-left').addEventListener('click', () => {
            const widthSlider = houseImage.offsetWidth;
            sliderContent.scrollLeft -= widthSlider;
        })

        houseImage.querySelector('.arrow-right').addEventListener('click', () => {
            const widthSlider = houseImage.offsetWidth;
            sliderContent.scrollLeft += widthSlider;
        })
    })


    // function previous() {
    //     const widthSlider = document.querySelector('.house-img').offsetWidth;
    //     document.querySelector('.slider-content').scrollLeft -= widthSlider
    // }

    // function next() {
    //     const widthSlider = document.querySelector('.house-img').offsetWidth;
    //     document.querySelector('.slider-content').scrollLeft += widthSlider
    // }