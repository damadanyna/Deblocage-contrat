<?php
  require './data.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <div class=" container">
        <form class="formulaire" method="POST" action="config.php" >
            <h1>Déblocage</h1>
            <div class="c_input">
                <span>Bdd</span>
                <select name="proxi" id="ip_" onmousedown="checkInput()"  onkeyup="checkInput()">
                    <option value="192.168.1.21" >BDD Teste</option>
                    <option value="192.168.1.253" >BDD En Production</option> 
                </select>
            </div> 
            <div class="c_input">
                <span>Agence</span> 
                <select name="db_name" id="agence_" onkeyup="checkInput()" >
                    <?php foreach ($agence  as $key => $value) : ?>
                         <option value="<?=$value['label']?>"><?= $value['agence']?></option> 
                        <?php endforeach;  ?> 
                </select>
            </div>
            <div class="c_input">
                <span>cpt_vcode</span>
                <input   type="number"  onkeyup="checkInput()" id="code_" name="v_code" placeholder="Saisir v_code">
            </div>
            <button id="btn_" type="submit">Débloquer</button>
        </form>
    </div>
    <script src="./index.js"></script>
</body>
</html>