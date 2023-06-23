const button = document.getElementById('button')

button.addEventListener('click', (event) => {
    event.preventDefault();

    const modal = document.getElementById('modal')
    modal.style.display = "flex"
    const modalContainer = document.getElementById('modal-container')

    document.addEventListener('click', (event) => {
        let clickInsideModalContainer = modalContainer.contains(event.target); // Check si l'utilisateur click dans le container
        let clickOutsideModalContainer = modal.contains(event.target) // Check si l'utilisateur check en dehors du container

        if (!clickInsideModalContainer && clickOutsideModalContainer) {
            modal.style.display = 'none'
        }
    }) 
})

const submitButton = document.getElementById('submit-modal-form');

submitButton.addEventListener('click', function(event) {
    event.preventDefault();

    const securityAnswer = document.getElementById('security-answer').value
    const newPassword = document.getElementById('new-password').value
    const confirmNewPassword = document.getElementById('confirm-new-password').value

    const formData = {
        securityAnswer,
        newPassword,
        confirmNewPassword
    }

    const form = new XMLHttpRequest()
    form.open('POST', 'http://localhost/OIKOS-Fullstack-Project/connection/forgot_password.php', true)
    form.onreadystatechange = function() {
        if (form.readyState === XMLHttpRequest.DONE){
            if (form.status === 200){
                const response = JSON.parse(form.responseText)
                if (response.error){
                    document.getElementById("display-error").innerHTML = response.error
                }else if (response.success){
                    window.location.href = "http://localhost/OIKOS-Fullstack-Project/connection/login.php";
                }
            }else{
                console.log("Erreur. Statut:", form.status)
            }
        }
    }
    form.send(JSON.stringify(formData))
})