// ----- Fonctionnalité "gérer le(s) rôle(s) d'un compte" -----

// const roleBtn = document.getElementById('role-btn')

// roleBtn.addEventListener('click', (event) => {
//     event.preventDefault()
// })

const activateBtn = document.getElementById('activate-btn')
const desactivateBtn = document.getElementById('desactivate-btn')
const deleteBtn = document.getElementById('delete-btn')


// ----- Fonctionnalité "activer un compte" -----
if (activateBtn) {
    activateBtn.addEventListener('click', (event) => {
        event.preventDefault()
        const activateMail = document.getElementById('activate-mail').value

        const activateForm = {
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
} else if (desactivateBtn) {
    desactivateBtn.addEventListener('click', (event) => {
        event.preventDefault()
        const desactivateMail = document.getElementById('desactivate-mail').value
    
        const desactivateForm = {
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
} else if (deleteBtn) {
    deleteBtn.addEventListener('click', (event) => {
        event.preventDefault()
        const deleteMail = document.getElementById('delete-mail').value
    
        const deleteForm = {
            deleteMail
        }
    
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
    })
}









