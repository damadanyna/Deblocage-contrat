<?php require './data.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deblocage</title>
    <link rel="stylesheet" href="./assets/index.css">
    <link rel="stylesheet" href="./assets/things.css">
    <link rel="stylesheet" href="./assets/validation.css">
    <script src="./assets/js/tailwind.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

</head>

<body>

    <div id="notification" class="">
        <span id="title" class=" text-xl">Effectuer</span>
        <span id="not_text"></span>
    </div>
    <div class="show-thing" id="show-thing">
        <div class="masque" id="masque">
            <div id="list_historique">
                <div id=" " class=" border-b border-stone-400 flex justify-between py-1">
                    <div class="">
                        <span id="">Archive </span>
                    </div>
                    <div onclick="tooglepopup(true)" title="Envoyer cette liste vers le DSI" class=" rounded-md py-1 px-3" style="color:  white; background:#16a34a;">
                        <span>Générer SQL</span>
                        <i class=" fas fa-database"></i>
                    </div>
                </div>
                <div id="c_liste" class="c_liste">
                </div>
            </div>
        </div>
        <div class="c_thing">
        </div>
        <div class="icon_thing" id="icon_thing">
            <span class="icon_">
                D
            </span>
            <div class="bar_content">
                <div class="bar_h" id="bar_h"></div>
                <div class="center_h"></div>
                <div class="bar_v" id="bar_v"></div>
            </div>
        </div>
    </div>
    <div class=" container">
        <!-- <form class="formulaire" method="POST" action="config.php"> -->
        <div class="formulaire">

            <div class="container___">
                <div class="container_p">
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                </div>
            </div>
            <div class="" style=" display:flex">
                <img style="width: 70px;" src="./assets/img/images.jpeg" alt="">
                <h1 class=" font-bold">Déblocage Contrat</h1>
            </div>
            <!-- <div class="c_input">
                <span class="label_in_">Base de Donnée</span>
                <select name="proxi" id="host_" onmousedown="checkInput()" onkeyup="checkInput()">
                    <option value="192.168.1.21">BDD Teste</option>
                    <option value="192.168.1.216">BDD prod</option>
                    <option value="192.168.1.253">BDD En Production</option>
                </select>
            </div> -->
            <div class="c_input">
                <span class="label_in_">Code agence</span>
                <select name="db_name" id="agence_" onkeyup="checkInput()">
                    <?php foreach ($agence  as $key => $value) : ?>
                        <option value="<?= $value['label'] ?>"><?= $value['agence'] ?></option>
                    <?php endforeach;  ?>
                </select>
            </div>

            <div class="c_input">
                <span class="label_in_">Clé RIB</span>
                <input onkeyup="checkInput()" style=" width:16rem" type="number" id="rib_" name="v_code" placeholder="Saisir Numéro de compte EPRS3">
            </div>

            <div class="c_input">
                <span class="label_in_">N° de compte EPRS3</span>
                <input onkeyup="checkInput()" style=" width:16rem" type="number" id="code_" name="v_code" placeholder="Saisir Numéro de compte EPRS3">
            </div>
            <div class="ml_">
                <button onclick="" id="btn_" class=" flex items-center bg-stone-500 text-white uppercase" style="font-weight:900;padding:11px 25px;width:250px">
                    <i class="fas fa-magnifying-glass"></i>
                    <span class=" text-sm ml-2"> Chercher le compte</span>
                </button>
            </div>
            <div class="ml_ ">
                <div onclick="showPopup()" class=" flex items-center hover:bg-green-200 border justify-center py-2 rounded-md border-green-600 text-green-600 uppercase cursor-pointer" style="width:15.6rem">
                    <i class="fas fa-bars"></i>
                    <span class=" text-sm ml-2"> Liste</span>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_validation" id="popup_validation">
        <div class="masque_validation" id="masque_validation">
        </div>
        <div id="result_list" class="validation_form" style="flex-direction:column">
            <div class="container___">
                <div class="container_p_">
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                </div>
            </div>
            <h1 class=" font-bold">Validation du compte</h1>
            <div class="input_form">
                <span class="label_in_">N° Compte</span>
                <h3 id="compte"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Nom du compte</span>
                <h3 id="blocage"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">RIB</span>
                <h3 id="nat"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Banque</span>
                <h3 id="cpt_banque"></h3>
            </div>
            <div class="" style="display: flex; flex-direction:column">
                <button title="Ajouter dans la liste des archives" id="save_btn" class=" font-bold text-white flex items-center justify-center" style="margin-top:30px;padding:10px 0px; width:300px;background:#16a34a;">
                    <i class="fas fa-plus "></i>
                    Ajouter
                </button>
            </div>
        </div>
        <div id="not_found" class="validation_form" style="flex-direction:column">
            <div class="container___">
                <div class="container_p_">
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                    <p><u></u></p>
                </div>
            </div>
            <h1>Validation du compte</h1>
            <span id="text_load">Chargement ... </span>

        </div>
    </div>
    <div id="confirmation" class="hidden absolute w-full h-full z-[10000] top-0 left-0 items-center justify-center  backdrop-blur-sm" style="background:rgba(0,0,0,.5)">
        <div class="flex flex-col bg-white rounded-lg border px-3 py-4 w-[27rem] ">
            <div class="flex items-flex">
                <i class="fas fa-exclamation text-xl bg-green-600 text-white px-3 rounded-full mr-2"></i>
                <span class=" text-green-600 text-xl font-bold">Générer et Télécharger?</span>
            </div>
            <span class="text-base mt-3">Souhaitez-vous Générer cette liste de comptes en SQL pour procéder au déblocage des contrats ?</span>
            <div class="flex flex-row w-full mt-3 justify-end">
                <button onclick="tooglepopup(false)" class=" text-sm uppercase px-3 py-1 bg-green-600 text-white">Non</button>
                <divx onclick="sendIt()" class=" ml-2 rounded-lg text-sm uppercase px-3 py-1 border border-stone-400 text-stone-400">
                    OUI
                    <i class=" fas fa-download "></i>
            </div>
        </div>
    </div>

    </div>
    <script type="module" src="./assets/js/desing.js"></script>
    <script src="./assets/js/event.js"></script>
</body>

</html>