const commentDeletionCross = document.querySelectorAll('.deletion-cross');
commentDeletionCross.forEach((cross) => {
    cross.addEventListener('click', () => {
        const commentDeletionRequest = new XMLHttpRequest();
        commentDeletionRequest.open('POST', '../../script/delete_review.php', true);
        commentDeletionRequest.onload = () => {
            if (commentDeletionRequest.status === 200) {
                let response = commentDeletionRequest.responseText;
                response = JSON.parse(response);
                console.log(response['Message']);
                cross.parentElement.parentElement.remove();
            } else {
                console.error('Erreur lors de la requête. Statut : ' + commentDeletionRequest.status);
            }
        };
        commentDeletionRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        commentDeletionRequest.send('review_id=' + cross.parentElement.parentElement.id);
    })
});

