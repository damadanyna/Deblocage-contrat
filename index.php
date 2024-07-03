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
</head>

<body>
    <div class="show-thing" id="show-thing">
        <div class="masque" id="masque">
            <div id="list_historique">
                <span id="container_l">Historique </span>
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
                <h1>Déblocage</h1>
            </div>
            <div class="c_input">
                <span class="label_in_">Base de Donnée</span>
                <select name="proxi" id="host_" onmousedown="checkInput()" onkeyup="checkInput()">
                    <option value="192.168.1.21">BDD Teste</option>
                    <option value="192.168.1.253">BDD En Production</option>
                </select>
            </div>
            <div class="c_input">
                <span class="label_in_">Code agence</span>
                <select name="db_name" id="agence_" onkeyup="checkInput()">
                    <?php foreach ($agence  as $key => $value) : ?>
                        <option value="<?= $value['label'] ?>"><?= $value['agence'] ?></option>
                    <?php endforeach;  ?>
                </select>
            </div>
            <div class="c_input">
                <span class="label_in_">Numéo de compte</span>
                <input type="number" onkeyup="checkInput()" id="code_" name="v_code" placeholder="Saisir v_code">
            </div>
            <div class="ml_">
                <button onclick="" id="btn_" style="font-weight:900;padding:11px 25px;width:250px">Chercher le compte</button>
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
            <h1>Validation du compte</h1>
            <div class="input_form">
                <span class="label_in_">N° Compte</span>
                <h3 id="compte"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Blocage</span>
                <h3 id="blocage"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Nat blocage</span>
                <h3 id="nat"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Solde Minimum</span>
                <h3 id="solde"></h3>
            </div>
            <div class="input_form">
                <span class="label_in_">Motif</span>
                <h3 id="motif"></h3>
            </div>
            <div class="" style="display: flex; flex-direction:column">

                <button id="debloc_btn" style="margin-top:30px;padding:10px 0px; width:300px;background:#0b773b;">Débloquer</button>
                <button id="annuler" style="margin-top:10px;padding:10px 0px; color:gray;background:white;border:1px solid gray">Annuler</button>
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
    <script type="module" src="./assets/js/desing.js"></script>
    <script src="./assets/js/event.js"></script>
</body>

</html>