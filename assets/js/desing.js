import { findAccount, getHistorique, checkLocal, tableauDATA } from './index.js';
var menu = document.getElementById('icon_thing');
var popup = document.getElementById('show-thing');
var masque = document.getElementById('masque');
var bar_h = document.getElementById('bar_h');
var bar_v = document.getElementById('bar_v');
var c_popup = document.getElementById('popup_validation')
var popup_ = document.getElementById('masque_validation');
var find = document.getElementById('btn_');
var save_btn = document.getElementById('save_btn');
// var tableauDATA = [];

const host_ = '192.168.1.253';
const agence_ = document.getElementById('agence_');
const num_compte_ = document.getElementById('code_');
const rib_ = document.getElementById('rib_');
const btn = document.getElementById('btn_');
// show-thing

menu.addEventListener('click', () => {
    popup.classList.add('anim-expand');
    popup.classList.remove('out-anim-expand');
    popup.style.background = '#00000034';
    masque.style.zIndex = 200;
    masque.style.opacity = 1;
    menu.style.zIndex = 0;
    menu.style.borderRight = '1px solid #16a34a';
})



// enregistrer()
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

save_btn.addEventListener('click', () => {
    // var data = {
    //     host: host_,
    //     dataBase: agence_.value,
    //     numCompte: num_compte_.value,
    //     rib: rib_.value,
    // };
    setTimeout(() => {
        console.log(tableauDATA);
        var tableauDATA_ = checkLocal();
        tableauDATA_.push(tableauDATA);
        localStorage.setItem('*-*', JSON.stringify(tableauDATA))
        notification.style.animation = 'showToggle 0.8s forwards'
        setTimeout(() => {
            window.location.reload()

        }, 100);
    }, 100);
    // enregistrer(tableauDATA);
    // updateContrat(data);
    // enregistrer();
    // getHistorique();
})



find.addEventListener('click', () => {
    if (host_ == "" ||
        agence_.value == "" ||
        rib_.value == "" ||
        num_compte_.value == "") {
        btn.style.background = "#555";
    } else {
        if (code_.value.length > 6) {
            btn.style.background = '#16a34a'
            showPopupValidation();
            var data = {
                host: host_,
                dataBase: agence_.value,
                numCompte: num_compte_.value,
                rib: rib_.value,
            };
            findAccount(data);

        }
    }
})

find.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        if (host_ == "" ||
            agence_.value == "" ||
            rib_.value == "" ||
            num_compte_.value == "") {
            btn.style.background = "#555";
        } else {
            if (code_.value.length > 6) {
                btn.style.background = '#16a34a'
                showPopupValidation();
                var data = {
                    host: host_,
                    dataBase: agence_.value,
                    numCompte: num_compte_.value,
                    rib: rib_.value,
                };
                findAccount(data);

            }
        }
    }
})
num_compte_.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        if (host_ == "" ||
            agence_.value == "" ||
            rib_.value == "" ||
            num_compte_.value == "") {
            btn.style.background = "#555";
        } else {
            if (code_.value.length > 6) {
                btn.style.background = '#16a34a'
                showPopupValidation();
                var data = {
                    host: host_,
                    dataBase: agence_.value,
                    numCompte: num_compte_.value,
                    rib: rib_.value,
                };
                findAccount(data);

            }
        }
    }
})

rib_.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        if (host_ == "" ||
            agence_.value == "" ||
            rib_.value == "" ||
            num_compte_.value == "") {
            btn.style.background = "#555";
        } else {
            if (code_.value.length > 6) {
                btn.style.background = '#16a34a'
                showPopupValidation();
                var data = {
                    host: host_,
                    dataBase: agence_.value,
                    numCompte: num_compte_.value,
                    rib: rib_.value,
                };
                findAccount(data);

            }
        }
    }
})


// tableauDATA = checkLocal();
window.addEventListener('load', () => {
    getHistorique();
})

// console.log(tableauDATA);

