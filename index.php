<?php
require './data.php'
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/index.css">
    <link rel="stylesheet" href="./assets/things.css">
</head>

<body>

    <script src="./index.js"></script>
    <div class="show-thing" id="show-thing">
        <div class="masque" id="masque"></div>
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
                <select name="proxi" id="ip_" onmousedown="checkInput()" onkeyup="checkInput()">
                    <option value="192.168.1.21">BDD Teste</option>
                    <option value="192.168.1.253">BDD En Production</option>
                </select>
            </div>
            <div class="c_input">
                <span class="label_in_">Cide agence</span>
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
                <button onclick="envoyerDonnees()" id="btn_" style="font-weight:900;padding:11px 25px;width:250px">Chercher le compte</button>
            </div>
        </div>
    </div>
    <script src="./desing.js"></script>
</body>

</html>