
document.addEventListener('DOMContentLoaded', () => {
    const httpRequest = new XMLHttpRequest();
    httpRequest.open('POST', 'index.php', true);
    httpRequest.onload = () => {
        if (httpRequest.status === 200) {
            const test = [];
            const response = JSON.parse(httpRequest.responseText);
            console.log(response);
            response.forEach(function(el) {
                if (!test.includes(el.title)) {
                    createElement(el)
                    test.push(el.title)
                }
              });
        } else {
            console.error('Erreur lors de la requête. Statut : ' + httpRequest.status);
        }
    };
    httpRequest.send()
});

const grid = document.querySelector('.grid');

function createElement(el){
    const pathImg = 'http://localhost/OIKOS-Fullstack-Project/uploads/'

    const link = document.createElement('a')
    grid.appendChild(link)
    link.href = 'http://localhost/OIKOS-Fullstack-Project/management_zone/housing.php?housing_id=' + el.housing_id

    const gridItem = document.createElement('div');
    gridItem.classList.add('grid-item')
    link.appendChild(gridItem);


    const gridItemImg = document.createElement('div');
    gridItemImg.classList.add('grid-item-img')
    gridItem.appendChild(gridItemImg);



    const gridItemContent = document.createElement('div');
    gridItemContent.classList.add('grid-item-content')
    gridItem.appendChild(gridItemContent);

    const gridItemTitle = document.createElement('div');
    gridItemTitle.classList.add('grid-item-title')
    gridItemContent.appendChild(gridItemTitle);


    const gridItemCapacity = document.createElement('div');
    gridItemCapacity.classList.add('grid-item-capacity')
    gridItemContent.appendChild(gridItemCapacity);

    const gridItemLocation = document.createElement('div');
    gridItemLocation.classList.add('grid-item-location')
    gridItemContent.appendChild(gridItemLocation);



    const img = document.createElement('img');
    gridItemImg.appendChild(img);
    img.src = pathImg + el.image

    const title = document.createElement('h4');
    gridItemTitle.appendChild(title);
    title.textContent = el.title;

    const capacity = document.createElement('p');
    gridItemCapacity.appendChild(capacity);
    capacity.textContent = el.number_of_pieces + " pièces " + el.area + " m²";

    const location = document.createElement('p');
    gridItemLocation.appendChild(location);
    location.textContent = el.district;

}

document.addEventListener('DOMContentLoaded', function(){ //Lance l'évenement quand la page est chargé
    const input = document.querySelector('input')
    let timeout; // On créé une variable qui prendra la fonction avecc un timeout est empechera les surcharges de requetes
    function getData(){
        const value = input.value
        if (value !== '') {
            clearTimeout(timeout); // Efface le timeout précédent
            timeout = setTimeout(function() {
            grid.innerHTML = ''
            test = []
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.length > 0){
                    response.forEach(function(el) {
                        if (!test.includes(el.title)) {
                            createElement(el)
                            test.push(el.title)
                        }
                        console.log(test)
                      });
                }else if(response.length <= 0){
                    const notFound = document.createElement('p')
                    notFound.textContent = 'Pas de résultats'
                    grid.appendChild(notFound)
                }
            }};
            xhr.send('value=' + encodeURIComponent(value)); 
        }, 300)
    }else if(value == '') {
        document.addEventListener('DOMContentLoaded', () => {
            const httpRequest = new XMLHttpRequest();
            httpRequest.open('POST', '../script/housing_list.php', true);
            httpRequest.onload = () => {
                if (httpRequest.status === 200) {
                    const test = [];
                    const response = JSON.parse(httpRequest.responseText);
                    console.log(response);
                    response.forEach(function(el) {
                        if (!test.includes(el.title)) {
                            createElement(el)
                            test.push(el.title)
                        }
                      });
                } else {
                    console.error('Erreur lors de la requête. Statut : ' + httpRequest.status);
                }
            };
            httpRequest.send()
        }); // Efface le contenu si l'input est vide
          }
    }
    input.addEventListener('input', getData)
})

const createHousingBtn = document.getElementById('housing-create-btn');

createHousingBtn.addEventListener('click', () => {
    console.log('yo');
    window.location.href = './housing_settings/create_housing.php';
});

const msgRedirectionBtn = document.getElementById('booking-msg-btn');
msgRedirectionBtn.addEventListener('click', () => {
    window.location.href = './gestion_messagerie/messagerie_gestion.php';
});