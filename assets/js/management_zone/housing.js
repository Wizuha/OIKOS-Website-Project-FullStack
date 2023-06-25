const opinionRedirectionBtn = document.getElementById('opinion-btn');

const modifyRedirectionBtn = document.getElementById('modify-btn');

opinionRedirectionBtn.addEventListener('click', (event) => {
    event.preventDefault();
    window.location.href = `./housing_settings/reviews_moderation.php?housing_id=${event.target.classList[1]}`;
});

modifyRedirectionBtn.addEventListener('click', (event) => {
    event.preventDefault();
    window.location.href = `./housing_settings/modify_housing.php?housing_id=${event.target.classList[1]}`;
});