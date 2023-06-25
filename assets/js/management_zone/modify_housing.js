const deleteHousingConfirmBtn = document.getElementById('confirm-delete-housing-btn');
        const deleteHousingCancelBtn = document.getElementById('cancel-delete-housing-btn');
        const deleteHousingConfirmBackground = document.getElementById('confirm-delete-housing-background');
        const deleteBookingConfirmBackground = document.getElementById('confirm-delete-booking-background');
        const deleteBookingConfirmBtn = document.getElementById('confirm-delete-booking-btn');
        const deleteBookingCancelBtn = document.getElementById('cancel-delete-booking-btn');
        function showConfirmationBox(callback, confirmBtn, cancelBtn, background) {
            confirmBtn.addEventListener('click', confirmation);
            cancelBtn.addEventListener('click', cancel);
            background.addEventListener('click', cancel);

            function confirmation() {
                hideConfirmBackground();
                if (typeof callback === 'function') {
                    callback(true);
                }
            }

            function cancel() {
                hideConfirmBackground();
                if (typeof callback === 'function') {
                    callback(false);
                }
            }

            function hideConfirmBackground() {
                background.classList.add('inactive');
                confirmBtn.removeEventListener('click', confirmation);
                cancelBtn.removeEventListener('click', cancel);
                background.removeEventListener('click', cancel);
            }
        }

        // Selection des boutons pour la suppressions des photos 
        const deleteHousingImgBtn = document.querySelectorAll('.delete-img-btn');

        // Ajout de la fonction de suppression pour chacun des boutons
        deleteHousingImgBtn.forEach((btn) => {
            btn.addEventListener('click', () => {
                // Içi on annule le comportement par default du bouton afin qu'il ne recharge pas la page
                event.preventDefault();

                // création d'un objet XMLHttprequest qui va permettre la création de requete asynchrone afin de ne pas avoir à recharger la page
                const deleteHousingImgRequest = new XMLHttpRequest();
                deleteHousingImgRequest.open('POST', '../../script/delete_housing_img.php', true);
                deleteHousingImgRequest.onload = () => {
                    if (deleteHousingImgRequest.status === 200) {
                        let response = deleteHousingImgRequest.responseText;
                        response = JSON.parse(response);
                        console.log(response['Message']);
                        btn.parentElement.remove();
                    } else {
                        console.error('Erreur lors de la requête. Statut : ' + deleteHousingImgRequest.status);
                    }
                };
                deleteHousingImgRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                deleteHousingImgRequest.send('img_id=' + btn.parentElement.id);
            })
        })
        
        const cancelBookingBtn = document.querySelectorAll('.booking-cancel');

        cancelBookingBtn.forEach((btn) => {
            btn.addEventListener('click', () => {
                deleteBookingConfirmBackground.classList.remove('inactive');
                showConfirmationBox((confirmation) => {
                    if (confirmation) {
                        const cancelBookingRequest = new XMLHttpRequest();
                        cancelBookingRequest.open('POST', '../../script/delete_booking.php', true);
                        cancelBookingRequest.onload = () => {
                            if (cancelBookingRequest.status === 200) {
                                let response  = cancelBookingRequest.responseText;
                                response = JSON.parse(response);
                                console.log(response['Message']);
                                btn.parentElement.parentElement.remove();
                            } else {
                                console.error('Erreur lors de la requête. Statut : ' + cancelBookingRequest.status);
                            }
                        };
                        cancelBookingRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        cancelBookingRequest.send('booking_id=' + btn.parentElement.parentElement.id);
                    }
                }, deleteBookingConfirmBtn, deleteBookingCancelBtn, deleteBookingConfirmBackground);
            });
        });

        const deleteHousingBtn = document.getElementById('delete-housing-btn');
        deleteHousingBtn.addEventListener('click', (event) => {
            event.preventDefault();
            deleteHousingConfirmBackground.classList.remove('inactive');
            showConfirmationBox((confirmation) => {
                if (confirmation) {
                    const deleteHousingRequest = new XMLHttpRequest();
                    deleteHousingRequest.open('POST', '../../script/delete_housing.php', true);
                    deleteHousingRequest.onload = () => {
                        if (deleteHousingRequest.status === 200) {
                            let response = deleteHousingRequest.responseText;
                            response = JSON.parse(response);
                            window.location.href = '../housing_list.php';
                        } else {
                            console.error(`Erreur lors de la requête. Statut: ${deleteHousingRequest.status}`);
                        }
                    };
                    deleteHousingRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    deleteHousingRequest.send('housing_id=' + deleteHousingBtn.name);
                }
            }, deleteHousingConfirmBtn, deleteHousingCancelBtn, deleteHousingConfirmBackground);            
        });