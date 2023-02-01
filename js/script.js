let btn = document.querySelector('.error__button')

if (btn) {
    btn.addEventListener('click', () => {
        document.querySelector('.error').style.display = 'none';
    })
}