<?php
function updata($con, $table, $vcode)
{
    try {
        $stmt = $con->prepare('UPDATE ' . $table . ' SET cpt_vblocage="non", cpt_vnatblocage="", cpt_fsoldemin="0" WHERE cpt_vcode=?');
        $stmt->bind_param("s", $vcode);

        $con->begin_transaction();
        $stmt->execute();
        $con->commit();
        $stmt->close();

        echo "Update successful!";
    } catch (\Throwable $th) {
        $con->rollback();
        echo "Error: " . $th->getMessage();
    }
}
function getData($config)
{
    // echo json_encode(["status" => "success", "data" => $config, "message" => "Update successful!"]);

    $conx = creat_cnx($config);

    try {
        // $stmt = $conx->prepare('select cpt_vblocage,cpt_vnatblocage,cpt_fsoldemin ' . $table . ' SET cpt_vblocage="non", cpt_vnatblocage="", cpt_fsoldemin="0" WHERE cpt_vcode=?');

        $stmt = $conx->prepare('SELECT * FROM clientele');
        $conx->begin_transaction();
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        }
        $conx->commit();
        $stmt->close();

        echo "Select successful!";
    } catch (Throwable $th) {
        $conx->rollback();
        echo "Error: " . $th->getMessage();
    }
}

function test()
{
    return json_encode('bonjour');
};




function creat_cnx($config)
{
    $host_ = $config['host'];
    $user_ = "root";
    $pwd_ = "";
    $db_ = $config["dataBase"];
    $config['host'] == 'localhost' ?   $pwd_ = "" :  $pwd_ = "clvohama";
    $user_con = new mysqli($host_, $user_, $pwd_, $db_);
    if ($user_con->connect_error) {
        error_log("Connexion échouée: " . $user_con->connect_error);
        die("Connection failed: " . $user_con->connect_error);
    }
    echo "Connecté";
    return $user_con;
}

// Gestion de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'getData') {
    $data = json_decode(file_get_contents('php://input'), true);


    // Assuming you have a database connection $con
    getData($data);
}
