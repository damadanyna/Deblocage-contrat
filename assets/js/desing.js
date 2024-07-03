import { findAccount, updateContrat, getHistorique, envoyerDonnees } from './index.js';
var menu = document.getElementById('icon_thing');
var popup = document.getElementById('show-thing');
var masque = document.getElementById('masque');
var bar_h = document.getElementById('bar_h');
var bar_v = document.getElementById('bar_v');
var c_popup = document.getElementById('popup_validation')
var popup_ = document.getElementById('masque_validation');
var annuler_ = document.getElementById('annuler');
var find = document.getElementById('btn_');
var debloc_btn = document.getElementById('debloc_btn');


const host_ = document.getElementById('host_');
const agence_ = document.getElementById('agence_');
const num_compte_ = document.getElementById('code_');
const btn = document.getElementById('btn_');
// show-thing

menu.addEventListener('click', () => {
    popup.classList.add('anim-expand');
    popup.classList.remove('out-anim-expand');
    popup.style.background = '#00000034';
    masque.style.zIndex = 200;
    masque.style.opacity = 1;
    menu.style.zIndex = 0;
    menu.style.borderRight = '1px solid #0b773b';
})

// envoyerDonnees()
masque.addEventListener('click', () => {
    popup.classList.add('out-anim-expand')
    popup.style.background = 'transparent';
    popup.classList.remove('anim-expand')
    masque.style.zIndex = 0;
    masque.style.opacity = 0;
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

debloc_btn.addEventListener('click', () => {
    var data = {
        host: host_.value,
        dataBase: agence_.value,
        numCompte: num_compte_.value,
    };
    updateContrat(data);
    envoyerDonnees();
    getHistorique();
})



find.addEventListener('click', () => {
    if (host_.value == "" ||
        agence_.value == "" ||
        client_id_.value == "") {
        btn.style.background = "#555";
    } else {
        if (code_.value.length > 6) {
            btn.style.background = '#0b773b'
            showPopupValidation();
            var data = {
                host: host_.value,
                dataBase: agence_.value,
                numCompte: num_compte_.value,
            };
            findAccount('Dany', data);
        }
    }
})

window.addEventListener('load', () => {
    getHistorique();
})