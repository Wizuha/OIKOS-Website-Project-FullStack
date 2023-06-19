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
