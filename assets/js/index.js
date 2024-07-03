var compte = document.getElementById('compte')
var blocage = document.getElementById('blocage')
var nat = document.getElementById('nat')
var solde = document.getElementById('solde')
var motif = document.getElementById('motif')
var result_list = document.getElementById('result_list');
var not_found = document.getElementById('not_found');
var historique_c = document.getElementById('c_liste');

var history_data = [];

function findAccount(data, config) {
    var xhr = new XMLHttpRequest();
    result_list.style.display = "none";
    not_found.style.display = "flex";
    not_found.innerHTML = " Chargement ...";
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                if (!xhr.responseText.includes('<')) {
                    var data = JSON.parse(xhr.responseText);
                    if (data.cpt_vcode != '') {
                        result_list.style.display = "flex"
                        not_found.style.display = "none"
                        compte.innerText = data.cpt_vcode;
                        blocage.innerText = data.cpt_vblocage;
                        nat.innerText = data.cpt_vnatblocage;
                        solde.innerText = data.cpt_fsoldemin;
                        motif.innerText = data.cpt_vmotifblocage;
                    } else {
                        result_list.style.display = "none"
                        not_found.style.display = "flex"
                        not_found.innerHTML = " Ce compte n'existe pas";
                    }
                } else {
                    result_list.style.display = "none"
                    not_found.style.display = "flex"
                    not_found.innerHTML = " Ce compte n'existe pas";
                }
            } else {
                console.error(`Error: ${xhr.status}`);
            }
        }
    };
    xhr.open("POST", "./controller/getAccount.php?action=getData", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    var donnees = JSON.stringify(config);
    xhr.send(donnees);

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
        action: 'RETRAIT',
        num_compte: client_id_.value
    };
    console.log(data);
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                window.location.reload()
            } else {
                console.error(`Error: ${xhr.status}`);
            }
        }
    };
    xhr.open("POST", "./controller/getAccount.php?action=insertHistory", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    var donnees = JSON.stringify(data);
    xhr.send(donnees);
}
function getHistorique() {
    var xhr = new XMLHttpRequest();
    let html = "";
    xhr.open('GET', './controller/getAccount.php?action=getHistory', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            history_data = JSON.parse(xhr.responseText);
            history_data.forEach(element => {
                // console.log(element);
                html += ` 
                    <div id="c_text">
                        <div class="" style="display:flex; place-items: center;">
                            <span style="width: 4px;height:4px; background:black; margin-right:15px"></span>
                            <span>${element.num_compte} , débloquer le</span>
                        </div>
                        <span> ${maque_date_time(element.date_insertion)}</span>
                    </div>
                `;
            });
            historique_c.innerHTML = html;
        }
    };
    xhr.send();
}
function updateContrat(config) {

    var data = {
        cpt_vblocage: 'non',
        cpt_vblocage: '',
        cpt_fsoldemin: 0,
        cpt_vmotifblocage: 'retrait',
        host: config.host,
        dataBase: config.dataBase,
        numCompte: config.numCompte,
    };
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // window.location.reload()
                console.log(xhr.responseText);
            } else {
                console.error(`Error: ${xhr.status}`);
            }
        }
    };
    xhr.open("POST", "./controller/getAccount.php?action=updateContrat", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    var donnees = JSON.stringify(data);
    xhr.send(donnees);
}

function maque_date_time(date) {
    return date.replace(' ', ' à ')
}

export { findAccount, envoyerDonnees, getHistorique, updateContrat };