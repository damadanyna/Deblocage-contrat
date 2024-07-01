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
function getData()
{
    echo json_encode(["status" => "success", "message" => "Update successful!"]);
    // creat_cnx($con,$table,$vcode);
    die("fin");
    try {
        $stmt = $con->prepare('select cpt_vblocage,cpt_vnatblocage,cpt_fsoldemin ' . $table . ' SET cpt_vblocage="non", cpt_vnatblocage="", cpt_fsoldemin="0" WHERE cpt_vcode=?');
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

function test()
{
    return json_encode('bonjour');
};




function creat_cnx($host_, $user_, $pwd_, $db_)
{
    $user_con = new mysqli($host_, $user_, $pwd_, $db_);
    if ($user_con->connect_error) {
        // Ajoutez un message de débogage pour la connexion échouée
        error_log("Connexion échouée: " . $user_con->connect_error);
        die("Connection failed: " . $user_con->connect_error);
    }
    return $user_con;
}

// Gestion de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'getData') {
    $data = json_decode(file_get_contents('php://input'), true);
    $table = "";
    $vcode = "";

    // Assuming you have a database connection $con
    getData();
}
