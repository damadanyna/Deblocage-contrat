

function findAccount(data, config) {

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.response);
        }
    };
    xhr.open("POST", "./controller/getAccount.php?action=getData", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    var donnees = JSON.stringify(config);
    xhr.send(donnees);
    xhr.response(data)
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

export { findAccount };