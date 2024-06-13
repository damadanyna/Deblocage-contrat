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


function envoyerDonnees() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr); // Affichez la réponse du serveur
        }
    };
    xhr.open("POST", "./controller/auth_controller.php?action=test", true);
    xhr.setRequestHeader("Content-Type", "application/json"); // Spécifiez le type de contenu

    var donnees = JSON.stringify({ nom: "Jean", age: 30 }); // Convertir les données en JSON
    xhr.send(donnees);
}