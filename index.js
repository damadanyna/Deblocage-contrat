const ip_ = document.getElementById('ip_');
const agence_ = document.getElementById('agence_');
const code_ = document.getElementById('code_');
const btn = document.getElementById('btn_');

function checkInput() {
    if (ip_.value == "" || agence_.value == "" || code_.value == "") {
        btn.style.background = "#555";
    } else {
        if (code_.value.length > 6) {
            btn.style.background = '#0b773b'
            appelerFonctionPHP();
            // window.location.href = "./controller/getAccount.php";
        }
    }
}
function appelerFonctionPHP() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './controller/getAccount.php?action=test', true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Réponse du serveur : ' + xhr.responseText);
            // Traitez la réponse ici
        }
    };

    xhr.send();
}
