import { findAccount } from './index.js';
var menu = document.getElementById('icon_thing');
var popup = document.getElementById('show-thing');
var masque = document.getElementById('masque');
var bar_h = document.getElementById('bar_h');
var bar_v = document.getElementById('bar_v');
var c_popup = document.getElementById('popup_validation')
var popup_ = document.getElementById('masque_validation');
var annuler_ = document.getElementById('annuler');
var find = document.getElementById('btn_');

const host_ = document.getElementById('host_');
const agence_ = document.getElementById('agence_');
const client_id_ = document.getElementById('code_');
const btn = document.getElementById('btn_');
// show-thing

menu.addEventListener('click', () => {
    popup.classList.add('anim-expand');
    popup.classList.remove('out-anim-expand');
    popup.style.background = '#00000034';
    masque.style.zIndex = 200;
    menu.style.zIndex = 0;
    menu.style.borderRight = '1px solid #0b773b';
})

// envoyerDonnees()
masque.addEventListener('click', () => {
    popup.classList.add('out-anim-expand')
    popup.style.background = 'transparent';
    popup.classList.remove('anim-expand')
    masque.style.zIndex = 0;
    menu.style.zIndex = 200;
    menu.style.borderRight = '1px solid transparent'
})

popup_.addEventListener('click', () => {
    hidePopupValidation()

})
annuler_.addEventListener('click', () => {
    hidePopupValidation()

})
function showPopupValidation() {

    c_popup.style.display = 'flex'
    c_popup.classList.remove('anim-opacityOut');
    c_popup.classList.add('anim-opacityIn');
}
function hidePopupValidation() {

    c_popup.classList.add('anim-opacityOut');
    c_popup.classList.remove('anim-opacityIn');
    setTimeout(() => {
        c_popup.classList.remove('anim-opacityOut');
        c_popup.style.display = 'none'

    }, 500);
}




find.addEventListener('click', () => {
    showPopupValidation();
    var data = {
        host: host_.value,
        dataBase: agence_.value,
        table: client_id_.value,
    };
    findAccount('Dany', data);
})