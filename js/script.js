let btn = document.querySelector('.error__button')

if (btn) {
    btn.addEventListener('click', () => {
        document.querySelector('.error').style.display = 'none';
    })
}

let favorClick = document.querySelector('#favorite_click');
let favorImg = document.querySelector('#favorite_img');
let favorText = document.querySelector('#favorite_text');
let spanCount = document.querySelector('.count__add');
if (favorClick) {
    favorClick.addEventListener('click', (e) => {

        if(favorImg.src.includes('favorite_close.png')){
            e.preventDefault();
            favorImg.src = '../../images/favorite_open.png';
            favorText.innerHTML = 'add to favorites';
            if (spanCount.innerHTML > 0) {
                spanCount.innerHTML = Number(spanCount.innerHTML) - 1;
            } else {
                spanCount.innerHTML = '';
            }
        } else {
            e.preventDefault();
            favorImg.src = '../../images/favorite_close.png';
            favorText.innerHTML = 'remove from favorites';
            if (spanCount.innerHTML == 0) {
                spanCount.innerHTML = 1;
            } else {
                spanCount.innerHTML = Number(spanCount.innerHTML) + 1;
            }
        }
       
    })
}