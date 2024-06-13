const host_ = document.getElementById('host_');
const agence_ = document.getElementById('agence_');
const client_id_ = document.getElementById('code_');
const btn = document.getElementById('btn_');

function checkInput() {
    if (host_.value == "" ||
        agence_.value == "" ||
        client_id_.value == "") {
        btn.style.background = "#555";
    } else {
        if (code_.value.length > 6) {
            btn.style.background = '#0b773b'
            // appelerFonctionPHP();
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
        }
    };

    xhr.send();
}


function envoyerDonnees() {
    var data = {
        host: host_.value,
        dataBase: agence_.value,
        table: client_id_.value,
    };
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.response);
        }
    };
    xhr.open("POST", "./controller/auth_controller.php?action=test", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    var donnees = JSON.stringify(data);
    xhr.send(donnees);
}