var compte = document.getElementById('compte')
var blocage = document.getElementById('blocage')
var nat = document.getElementById('nat')
var solde = document.getElementById('solde')
var motif = document.getElementById('motif')
var result_list = document.getElementById('result_list');
var not_found = document.getElementById('not_found');
var historique_c = document.getElementById('c_liste');
var notification = document.getElementById('notification');
var not_text = document.getElementById('not_text');
var cpt_banque = document.getElementById('cpt_banque');

var history_data = [];
var localData = [];
var tableauDATA = checkLocal();
function findAccount(config) {
    var gettingData = {};
    var xhr = new XMLHttpRequest();
    result_list.style.display = "none";
    not_found.style.display = "flex";
    not_found.innerHTML = " Chargement ...";
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText !== '') {
                    if (!xhr.responseText.includes('<')) {
                        var data = JSON.parse(xhr.responseText);
                        if (data.cpt_vcode != '') {
                            result_list.style.display = "flex"
                            not_found.style.display = "none"
                            compte.innerText = data.cpt_vcode;
                            blocage.innerText = data.cpt_vlib;
                            nat.innerText = data.cpt_vrib;
                            cpt_banque.innerText = data.cpt_vbanque;

                            gettingData.cpt_vcode = data.cpt_vcode;
                            gettingData.cpt_vlib = data.cpt_vlib;
                            gettingData.cpt_vrib = data.cpt_vrib;
                            gettingData.cpt_vbanque = data.cpt_vbanque;
                            gettingData.dataBase = config.dataBase;
                            tableauDATA.push(gettingData);
                            // localStorage.setItem('*-*', JSON.stringify(tableauDATA))
                            // console.log("Mise en storageLocal fait");
                            // console.log(gettingData);
                        } else {
                            result_list.style.display = "none"
                            not_found.style.display = "flex"
                            not_found.innerHTML = " Ce compte n'existe pas";
                        }
                    }
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
        }
    };
    xhr.open("POST", "./controller/getAccount.php?action=findAccount", true);
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


function enregistrer(gettingData) {
    var tableauDATA = checkLocal();
    tableauDATA.push(gettingData);
    localStorage.setItem('*-*', JSON.stringify(tableauDATA))
    console.log(tableauDATA);
    // var data = {
    //     action: 'ENVOIE',
    //     num_compte: client_id_.value
    // };
    // console.log(data);
    // var xhr = new XMLHttpRequest();

    // xhr.onreadystatechange = () => {
    //     if (xhr.readyState === 4) {
    //         if (xhr.status === 200) {
    //             notification.style.animation = 'showToggle 0.8s forwards'
    //             not_text.innerText = compte.innerText
    //             setTimeout(() => {
    //                 window.location.reload()
    //             }, 3500);
    //         } else {
    //             console.error(`Error: ${xhr.status}`);
    //         }
    //     }
    // };
    // xhr.open("POST", "./controller/getAccount.php?action=insertHistory", true);
    // xhr.setRequestHeader("Content-Type", "application/json");
    // var donnees = JSON.stringify(data);
    // xhr.send(donnees);
}
function getHistorique() {
    var tp = checkLocal();
    // var xhr = new XMLHttpRequest();
    let html = "";
    // xhr.open('GET', './controller/getAccount.php?action=getHistory', true);
    // xhr.onload = function () {
    //     if (xhr.status === 200) {
    //         history_data = JSON.parse(xhr.responseText);
    tp.forEach(element => {
        html += ` 
                    <div id="c_text">
                        <div class="" style="display:flex; place-items: center;">
                            <span style="width: 4px;height:4px; background:black; margin-right:15px"></span>
                            <span>${element.cpt_vlib} ,</span>
                            <span>N° ${element.cpt_vcode}, </span>
                            <span>RIB ${element.cpt_vrib} </span>
                        </div>
                        <span style="color:'gray'"> Non envoyé </span>
                    </div>
                `;
    });
    historique_c.innerHTML = html;

    //     }
    // };
    // xhr.send();
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

function checkLocal() {
    var local = window.localStorage;
    if (local.getItem('*-*')) {
        return JSON.parse(local.getItem('*-*'))
    } else {
        return [];
    }
}
function convert() {

}
// function setLocal(item) {
// localData.push(item);
// localStorage.setItem('*-*', JSON.stringify(item))
// console.log(item);
// }

// checkLocal();

export { findAccount, enregistrer, getHistorique, updateContrat, checkLocal, tableauDATA };