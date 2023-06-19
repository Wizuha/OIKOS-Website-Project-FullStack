
function ajax(id, state) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          // La requête est terminée
          if (xhr.status === 200) {
            // La réponse a été reçue avec succès
            console.log(xhr.responseText); // Afficher la réponse dans la console
          } else {
            // La requête a échoué
            console.log('Erreur de la requête');
          }
        }
      };
    xhr.open('POST', 'script_favorite.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + encodeURIComponent(id) + '&state=' + encodeURIComponent(state));
}



// Permet de renvoyer l'id de la maison sur laquelle est le like 
const favorites = document.getElementsByClassName('svg-heart')
Array.from(favorites).forEach(favorite => {
    favorite.addEventListener('click' , () => {
        let fillValue = favorite.style.fill; // Permet de récupérer la couleur de l'élément cliqué
        let color = 'rgb(221, 63, 87)';
        let state;
        let id;
        if (fillValue == "none") {
            favorite.style.fill = color
            id = favorite.dataset.value; 
            state = 'add'
            ajax(id, state)

        }else{
            favorite.style.fill = 'none'
            id = favorite.dataset.value; 
            state = 'remove'
            ajax(id, state)
        }
    })
})

