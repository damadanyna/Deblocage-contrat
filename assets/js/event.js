
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

