const menu = document.querySelector('.icon-account-menu')
const dropdown = document.querySelector('.dropdown')



menu.addEventListener('click', (event) => {
    if (window.getComputedStyle(dropdown).display === 'none'){
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            const response = xhr.responseText; // Afficher la réponse dans la console
            const data = JSON.parse(response);
            console.log(data)
            if(data.isconnected){
              const isManager = data.ismanager
              const isLogistician = data.ismaintenance
              const isAdmin = data.isadmin
              displayHeaderConnected(isManager, isLogistician, isAdmin)
            }else{
                displayHeaderDisonnected()
            }
          } else {
            console.log('Erreur de la requête');
          }
        }
      };
    xhr.open('POST', 'http://localhost/OIKOS-Fullstack-Project/script/script_header.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();
    document.addEventListener('click',(event) =>{
      const clickedElement = event.target
      const isInsideModal = dropdown.contains(clickedElement) 
      if(!isInsideModal){
        dropdown.style.display = 'none'
        dropdownLength = dropdown.childNodes
        dropdownLength.forEach(div => {
          dropdown.removeChild(div)
        });
      }
    })}
})

function displayHeaderConnected(isManager, isLogistician, isAdmin){
    dropdown.style.display = 'flex'
    const firstDiv = document.createElement('div')
    const firstDivLink = document.createElement('a')
    const firstDivP = document.createElement('p')
    dropdown.appendChild(firstDiv)
    firstDiv.appendChild(firstDivLink)
    firstDivLink.appendChild(firstDivP)
    firstDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/client_zone/profile/profile.php '
    firstDivP.textContent = 'Mon compte'

    const secondDiv = document.createElement('div')
    const secondDivLink = document.createElement('a')
    const secondDivP = document.createElement('p')
    dropdown.appendChild(secondDiv)
    secondDiv.appendChild(secondDivLink)
    secondDivLink.appendChild(secondDivP)

    secondDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/client_zone/booking/booking_history.php'
    secondDivP.textContent = 'Vos réservations'


    const thirdDiv = document.createElement('div')
    const thirdDivLink = document.createElement('a')
    const thirdDivP = document.createElement('p')
    dropdown.appendChild(thirdDiv)
    thirdDiv.appendChild(thirdDivLink)
    thirdDivLink.appendChild(thirdDivP)

    thirdDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/client_zone/clients_messagerie/index.php'
    thirdDivP.textContent = 'Messagerie'


    if(isManager){
      const fourthDiv = document.createElement('div')
      const fourthDivLink = document.createElement('a')
      const fourthDivP = document.createElement('p')
      dropdown.appendChild(fourthDiv)
      fourthDiv.appendChild(fourthDivLink)
      fourthDivLink.appendChild(fourthDivP)
  
      fourthDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/management_zone/housing_list.php'
      fourthDivP.textContent = 'Gestion'
    }

    if(isLogistician)
    {
      const seventhDiv = document.createElement('div')
      const seventhDivLink = document.createElement('a')
      const seventhDivP = document.createElement('p')
      dropdown.appendChild(seventhDiv)
      seventhDiv.appendChild(seventhDivLink)
      seventhDivLink.appendChild(seventhDivP)
  
      seventhDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/maintenance_zone/maintenance_list.php'
      seventhDivP.textContent = 'Logistique'
    }

    if(isAdmin)
    {
      const heightDiv = document.createElement('div')
      const heightDivLink = document.createElement('a')
      const heightDivP = document.createElement('p')
      dropdown.appendChild(heightDiv)
      heightDiv.appendChild(heightDivLink)
      heightDivLink.appendChild(heightDivP)
  
      heightDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/admin_zone/users_options.php'
      heightDivP.textContent = 'Administration'
    }
  
    const fifthDiv = document.createElement('div')
    dropdown.appendChild(fifthDiv)
    fifthDiv.classList.add('separator')

    const sixthDiv = document.createElement('div')
    const sixthDivLink = document.createElement('a')
    const sixthDivButton = document.createElement('button')
    dropdown.appendChild(sixthDiv)
    sixthDiv.appendChild(sixthDivLink)
    sixthDivLink.appendChild(sixthDivButton)
    sixthDivButton.textContent  = 'Déconnexion'
    sixthDiv.classList.add('btn-dropdown')
    sixthDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/connection/logout.php'

    // dropdown.style.height = '140px'

}


function displayHeaderDisonnected(){
    const dropdown = document.querySelector('#dropdown')
    dropdown.style.display = 'flex'

    const firstDiv = document.createElement('div')
    const firstDivLink = document.createElement('a')
    const firstDivP = document.createElement('p')
    dropdown.appendChild(firstDiv)
    firstDiv.appendChild(firstDivLink)
    firstDivLink.appendChild(firstDivP)

    firstDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/connection/register.php'
    firstDivP.textContent = 'Inscription'



    const secondDiv = document.createElement('div')
    const secondDivLink = document.createElement('a')
    const secondDivP = document.createElement('p')
    dropdown.appendChild(secondDiv)
    secondDiv.appendChild(secondDivLink)
    secondDivLink.appendChild(secondDivP)

    secondDivLink.href = 'http://localhost/OIKOS-Fullstack-Project/connection/login.php'
    secondDivP.textContent = 'Connexion'

    const thirdDiv = document.createElement('div')
    dropdown.appendChild(thirdDiv)
    thirdDiv.classList.add('separator')

    const fourthDiv = document.createElement('div')
    const fourthDivP = document.createElement('p')
    const fourthDivLink = document.createElement('a')
    dropdown.appendChild(fourthDiv)
    fourthDiv.appendChild(fourthDivLink)
    fourthDivLink.appendChild(fourthDivP)
    fourthDivP.textContent = 'Aide'
          
    dropdown.style.height = '280%'
}