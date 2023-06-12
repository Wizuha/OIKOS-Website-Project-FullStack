const btn = document.querySelector('#btn')
console.log("there")
btn.addEventListener('click', () => {
    console.log('here')
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