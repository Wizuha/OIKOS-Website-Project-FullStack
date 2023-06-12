// Bouton de la première partie du formulaire
const btn = document.getElementById('btn')

// Event déclenché quand le bouton de la première partie du formulaire est cliqué
btn.addEventListener('click', (event) => {
    event.preventDefault();

    // Récupération et stockage des values insérées dans les champs de la première partie du formulaire
    const lastname = document.getElementById('lastname').value;
    const mail = document.getElementById('mail').value;
    const phoneNumber = document.getElementById('phone-number').value;
    const password = document.getElementById('password').value;
    const firstname = document.getElementById('firstname').value;
    const birthDate = document.getElementById('birth-date').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    // Affichage du modal contenant la deuxième partie du formulaire
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

        // Bouton de la deuxième partie du formulaire
        const submitButton = document.getElementById('submit-modal-form');

        // Event déclenché quand le bouton de la deuxième partie du formulaire est cliqué
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();

            // Récupération et stockage des values insérées dans les champs de la deuxième partie du formulaire
            const securityQuestion = document.querySelector('select[name="security-question"]').value;
            const securityAnswer = document.getElementById('security-answer').value;

            // JSON contenant toutes les values insérées dans le formulaire ;
            // les clés n'apparaissent pas car elles sont équivalentes au name des input du formulaire
            const formData = {
                lastname,
                mail,
                phoneNumber,
                password,
                firstname,
                birthDate,
                confirmPassword,
                securityQuestion,
                securityAnswer
            };

            // Création d'un objet XMLHttpRequest
            const form = new XMLHttpRequest();
            // On spécifie la méthode et le lien du fichier php
            form.open('POST', 'http://localhost/OIKOS-Fullstack-Project-TEST/connection/register.php', true);
            // On spécifie le format du contenu envoyé par la requête, ici JSON
            form.setRequestHeader('Content-Type', 'application/json');

            // Gestion de la réponse du serveur à la requête
            form.onreadystatechange = function() {
                if (form.readyState === XMLHttpRequest.DONE) {
                    // statut de la requête = 200 => succés de la requête
                    if (form.status === 200) {
                        console.log(form.responseText)

                        const response = JSON.parse(form.responseText);

                        // Si la réponse porte la clé error, on affiche l'erreur dans la div possédant l'id "display-error"
                        // Si la réponse porte la clé success, on redirige vers la page login.php
                        if (response.error){
                            document.getElementById("display-error").innerHTML = response.error;
                        } else if (response.success) {
                            window.location.href = "http://localhost/OIKOS-Fullstack-Project/connection/login.php";
                        }
                    // statut de la requête != 200 => echec de la requête
                    } else {
                        console.log("Erreur. Statut:", form.status);
                    }
                }
            };
            // Envoie du JSON formData
            form.send(JSON.stringify(formData));
        });
    })
