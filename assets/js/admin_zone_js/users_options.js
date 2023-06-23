
// Fonctions pour le dropdown des suggestions de mail
function createElement(mail){
    const div = document.createElement('div')
    div.classList.add('row')
    const p = document.createElement('p')
    p.textContent = mail
    div.appendChild(p)
    return div
}

function clearDropdown(dropdown) {
    dropdown.innerHTML = '';
}
    
function updateDropdown(response, dropdown, mail) {
    clearDropdown(dropdown)
    response.forEach(el => {
        const div = createElement(el['mail'])
        dropdown.appendChild(div)
    });

    const divs = document.getElementsByClassName('row');
    Array.from(divs).forEach(singleDiv => {
        singleDiv.addEventListener('click', () => {
            let p = singleDiv.querySelector('p');
            mail.value = p.textContent;
        });
    });
}

function getData(dropdown, mail){
    clearDropdown(dropdown);
    const value = mail.value;
    
    if (value !== ""){
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'script.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                updateDropdown(response, dropdown, mail);
            }
        };
        xhr.send('value=' + encodeURIComponent(value));
    }
}

// Dropdown de la fonctionnalité de la gestion des rôles
const roleMail = document.getElementById('role-mail')
const roleDropdown = document.getElementById('role-dropdown')

document.addEventListener('DOMContentLoaded', function(){
    // getData(roleDropdown, roleMail)
    roleMail.addEventListener('input', function() {
        getData(roleDropdown, roleMail)    
    });
});

const activateMail2 = document.getElementById('activate-mail')
const activateDropdown = document.getElementById('activate-dropdown')

document.addEventListener('DOMContentLoaded', function(){
    // getData(roleDropdown, roleMail)
    activateMail2.addEventListener('input', function() {
        getData(activateDropdown, activateMail2)    
    });
});

const desactivateMail2 = document.getElementById('desactivate-mail')
const desactivateDropdown = document.getElementById('desactivate-dropdown')

document.addEventListener('DOMContentLoaded', function(){
    // getData(roleDropdown, roleMail)
    desactivateMail2.addEventListener('input', function() {
        getData(desactivateDropdown, desactivateMail2)    
    });
});

const deleteMail2 = document.getElementById('delete-mail')
const deleteDropdown = document.getElementById('delete-dropdown')

document.addEventListener('DOMContentLoaded', function(){
    // getData(roleDropdown, roleMail)
    deleteMail2.addEventListener('input', function() {
        getData(deleteDropdown, deleteMail2)    
    });
});


// ----- Fonctionnalité "activer un compte" -----
const activateBtn = document.getElementById('activate-btn')

activateBtn.addEventListener('click', (event) => {
    event.preventDefault()
    const activateMail = document.getElementById('activate-mail').value

    const activateForm = {
        type: 'activate',
        activateMail
    }

    const activateXHR = new XMLHttpRequest()
    activateXHR.open('POST', "http://localhost/OIKOS-Fullstack-Project/admin_zone/users_options.php", true)
    activateXHR.setRequestHeader('Content-Type', 'application/json')

    activateXHR.onreadystatechange = function() {
        if (activateXHR.readyState === XMLHttpRequest.DONE) {
            if (activateXHR.status === 200) {
                console.log(activateXHR.responseText)
                const activateResponse = JSON.parse(activateXHR.responseText) 
                
                if (activateResponse.error) {
                    document.getElementById('activate-msg').innerHTML = activateResponse.error
                } else if (activateResponse.success) {
                    document.getElementById('activate-msg').innerHTML = activateResponse.success
                }
            } else {
                console.log("Erreur. Statut:", activateXHR.status)
            }
        }
    }
    activateXHR.send(JSON.stringify(activateForm))
})

// ----- Fonctionnalité "désactiver un compte" -----
const desactivateBtn = document.getElementById('desactivate-btn')

desactivateBtn.addEventListener('click', (event) => {
    event.preventDefault()
    const desactivateMail = document.getElementById('desactivate-mail').value

    const desactivateForm = {
        type: 'desactivate',
        desactivateMail
    }

    const desactivateXHR = new XMLHttpRequest()
    desactivateXHR.open('POST', "http://localhost/OIKOS-Fullstack-Project/admin_zone/users_options.php", true)
    desactivateXHR.setRequestHeader('Content-Type', 'application/json')

    desactivateXHR.onreadystatechange = function() {
        if (desactivateXHR.readyState === XMLHttpRequest.DONE) {
            if (desactivateXHR.status === 200) {
                console.log(desactivateXHR.responseText)
                const desactivateResponse = JSON.parse(desactivateXHR.responseText) 
                
                if (desactivateResponse.error) {
                    document.getElementById('desactivate-msg').innerHTML = desactivateResponse.error
                } else if (desactivateResponse.success) {
                    document.getElementById('desactivate-msg').innerHTML = desactivateResponse.success
                }
            } else {
                console.log("Erreur. Statut:", desactivateXHR.status)
            }
        }
    }
    desactivateXHR.send(JSON.stringify(desactivateForm))
})

// ----- Fonctionnalité "supprimer un compte" -----
const deleteBtn = document.getElementById('delete-btn')

deleteBtn.addEventListener('click', (event) => {
    event.preventDefault()
    const deleteMail = document.getElementById('delete-mail').value

    const deleteForm = {
        type: 'delete',
        deleteMail
    }

    // modal confirmer
    const modal = document.getElementById('modal')
    modal.style.display = "flex"
    const modalContainer = document.getElementById('modal-container')

    // Gestion de l'affichage et fermeture du modal
    document.addEventListener('click', (event) => {
        let clickInsideModalContainer = modalContainer.contains(event.target); // Check si l'utilisateur clique dans le container
        let clickOutsideModalContainer = modal.contains(event.target) // Check si l'utilisateur clique en dehors du container

        // Fermeture du modal quand on clique en dehors
        if (!clickInsideModalContainer && clickOutsideModalContainer) {
            modal.style.display = 'none'
        }
    })

    const confirmDeletion = document.getElementById('confirm-deletion')

    confirmDeletion.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'none'

        const deleteXHR = new XMLHttpRequest()
        deleteXHR.open('POST', "http://localhost/OIKOS-Fullstack-Project/admin_zone/users_options.php", true)
        deleteXHR.setRequestHeader('Content-Type', 'application/json')

        deleteXHR.onreadystatechange = function() {
            if (deleteXHR.readyState === XMLHttpRequest.DONE) {
                if (deleteXHR.status === 200) {
                    console.log(deleteXHR.responseText)
                    const deleteResponse = JSON.parse(deleteXHR.responseText) 
                    
                    if (deleteResponse.error) {
                        document.getElementById('delete-msg').innerHTML = deleteResponse.error
                    } else if (deleteResponse.success) {
                        document.getElementById('delete-msg').innerHTML = deleteResponse.success
                    }
                } else {
                    console.log("Erreur. Statut:", deleteXHR.status)
                }
            }
        } 
        deleteXHR.send(JSON.stringify(deleteForm))
    }, { once: true })
})