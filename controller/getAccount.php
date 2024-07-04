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

function findAccount($config)
{
    $conx = creat_cnx($config);
    if ($conx->connect_error) {
        die("Connection failed: " . $conx->connect_error);
    }

    $vcode = (string)$config["numCompte"];
    $query = "SELECT * FROM contrat WHERE cpt_vcode = ?";
    $rep = "vide";

    $stmt = $conx->prepare($query);
    if (!$stmt) {
        die("Statement preparation failed: " . $conx->error);
    }

    $stmt->bind_param("s", $vcode);

    $conx->begin_transaction();
    if (!$stmt->execute()) {
        $conx->rollback();
        die("Statement execution failed: " . $stmt->error);
    }
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rep = [
            "cpt_vcode" => $row["cpt_vcode"],
            "cpt_vblocage" => $row["cpt_vblocage"],
            "cpt_vnatblocage" => $row["cpt_vnatblocage"],
            "cpt_fsoldemin" => $row["cpt_fsoldemin"],
            "cpt_vmotifblocage" => $row["cpt_vmotifblocage"]
        ];
        echo json_encode($rep);
    } else {
        $rep = [
            "cpt_vcode" => "",
            "cpt_vblocage" => "",
            "cpt_vnatblocage" => "",
            "cpt_fsoldemin" => "",
            "cpt_vmotifblocage" => ""
        ];
        echo json_encode($rep);
    }

    $result->free_result(); // Libérer les résultats avant de poursuivre
    $conx->commit();
    $stmt->close();
    $conx->close();
}


function insertHistory($data)
{
    $config = [
        "host" => "192.168.1.216",
        "user" => "itdev",
        "pwd" => "clvohama",
        "dataBase" => 'config'
    ];
    $conx = creat_cnx($config);
    try {
        $stmt = $conx->prepare('INSERT INTO hisorique_deb (action, num_compte) VALUES (?, ?)');
        $stmt->bind_param("ss", $data["action"], $data["num_compte"]);
        $conx->begin_transaction();
        $stmt->execute();
        echo json_encode(["status" => "success", "data" => "", "message" => "Update successful!"]);
        $conx->commit();
        $stmt->close();
        $conx->close();
    } catch (\Throwable $th) {
        $conx->rollback();
        echo "Error: " . $th->getMessage();
    }
}
function updateContrat($config)
{
    $cpt_vmotif = $config["cpt_vmotifblocage"];
    $cpt_soldmin = $config["cpt_fsoldemin"];
    $blocate = $config["cpt_vblocage"];
    // echo json_encode($config);
    $config = [
        "host" => $config['host'],
        "dataBase" => $config['dataBase']
    ];
    $conx = creat_cnx($config);
    try {
        $stmt = $conx->prepare('UPDATE contrat SET cpt_vblocage= ?, cpt_fsoldemin= ?, cpt_vmotifblocage= ?');
        $stmt->bind_param("sss", $blocate, $cpt_soldmin, $cpt_vmotif);
        $conx->begin_transaction();
        $stmt->execute();
        echo json_encode(["status" => "success", "data" => "", "message" => "Update successful!"]);
        $conx->commit();
        $stmt->close();
        $conx->close();
    } catch (\Throwable $th) {
        $conx->rollback();
        echo "Error: " . $th->getMessage();
    }
}

function getHistory()
{
    $config = [
        "host" => "192.168.1.216",
        "user" => "itdev",
        "pwd" => "clvohama",
        "dataBase" => 'config'
    ];
    $conx = creat_cnx($config);
    try {
        $stmt = $conx->prepare('SELECT * FROM hisorique_deb  ORDER BY date_insertion DESC LIMIT 100 ');
        $conx->begin_transaction();
        $stmt->execute();
        $result = $stmt->get_result();

        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
        echo json_encode($history);

        $conx->commit();
        $stmt->close();
        $conx->close();
    } catch (\Throwable $th) {
        $conx->rollback();
        echo "Error: " . $th->getMessage();
    }
}

function test()
{
    return json_encode('bonjour');
}

function creat_cnx($config)
{
    $host_ = $config['host'];
    $user_ = "root";
    $pwd_ = "";
    $db_ = $config["dataBase"];
    if ($config['host'] == 'localhost') {
        $pwd_ = "";
    } else if ($config['host'] == '192.168.1.216') {
        $user_ = "itdev";
        $pwd_ = "clvohama";
    } else {
        $user_ = "root";
        $pwd_ = "clvohama";
    }
    $user_con = new mysqli($host_, $user_, $pwd_, $db_);
    if ($user_con->connect_error) {
        error_log("Connexion échouée: " . $user_con->connect_error);
        die("Connection failed: " . $user_con->connect_error);
    }
    return $user_con;
}

// Gestion de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($_GET['action'] === 'findAccount') {
        findAccount($data);
    } else if ($_GET['action'] === 'insertHistory') {
        insertHistory($data);
    } else if ($_GET['action'] === 'updateContrat') {
        updateContrat($data);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'getHistory') {
        getHistory();
    }
}
