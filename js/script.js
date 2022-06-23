let loginPopup = document.querySelector('.login__popup');
let regPopup = document.querySelector('.register__popup');

let closeLogin = document.querySelector('.login__close');
let closeReg = document.querySelector('.register__close');

let loginLink = document.querySelector('#login');
let regLink = document.querySelector('#register');

loginLink.addEventListener('click', function(e){
    loginPopup.style.display = "block";
    e.preventDefault();
});
regLink.addEventListener('click', function(e){
    regPopup.style.display = "block";
    e.preventDefault();
});

closeLogin.addEventListener('click', function(){
    loginPopup.style.display = "none";
});

closeReg.addEventListener('click', function(){
    regPopup.style.display = "none";
})
