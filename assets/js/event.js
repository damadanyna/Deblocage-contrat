

const agence_ = document.getElementById('agence_');
const client_id_ = document.getElementById('code_');
const btn = document.getElementById('btn_');
const rib_ = document.getElementById('rib_');

var menu = document.getElementById('icon_thing');
var popup = document.getElementById('show-thing');
var masque = document.getElementById('masque');

function checkInput() {
    if (agence_.value == "" || client_id_.value == "" || rib_.value == "") {
        btn.style.background = "#555";
    } else {
        if (code_.value.length > 6) {
            btn.style.background = '#16a34a'
            // appelerFonctionPHP();
            // window.location.href = "./controller/getAccount.php";
        }
    }
}


function tooglepopup(val) {
    const content = document.getElementById('confirmation');
    if (val == true) {
        content.style.display = 'flex';
    } else {
        content.style.display = 'none';
    }
}
function sendIt() {
    var temp = checkLocal();
    var sql = "";
    if (temp.length != 0) {
        console.log(temp);
        temp.forEach(element => {
            sql += generateRequest(element.dataBase, element.cpt_vcode, element.cpt_vbanque, element.dataBase.substring(6), element.cpt_vrib);
        });
    } else {

    }
    if (sql != "") {
        console.log("success");
        download(sql);
    }
}
function showPopup() {
    popup.classList.add('anim-expand');
    popup.classList.remove('out-anim-expand');
    popup.style.background = '#00000034';
    masque.style.zIndex = 200;
    masque.style.opacity = 1;
    menu.style.zIndex = 0;
    menu.style.borderRight = '1px solid #16a34a';
}
function checkLocal() {
    var local = window.localStorage;
    if (local.getItem('*-*')) {
        return JSON.parse(local.getItem('*-*'))
    } else {
        return [];
    }
}

function generateRequest(db, cpt_code, cpt_banque, agence_, rib) {
    return `
    UPDATE ${db}.contrat  SET cpt_vblocage = '',  cpt_vnatblocage = '',  cpt_fsoldemin = '0' 
    WHERE contrat.cpt_vcode = '${cpt_code}' AND contrat.cpt_vbanque = '${cpt_banque}'   AND contrat.cpt_vbranche = '${agence_}' 
    AND contrat.cpt_vrib = '${rib}';`;


}

function download(data) {
    var blob = new Blob([data], { type: 'text/sql' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'script.sql';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    window.localStorage.setItem('*-*', []);
    tooglepopup(false)
};