<?php
// require './controller/config.php';
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


function setData($con, $table, $vcode)
{
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
// Vérifiez l'action et appelez la fonction appropriée
if (isset($_GET['action']) && $_GET['action'] === 'test') {
    test();
}

function test()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ajoutez un message de débogage pour vérifier les données reçues
        error_log('Requête POST reçue');

        $input = json_decode(file_get_contents('php://input'), true);

        if ($input) {
            $host = $input['host'];
            $db = $input['dataBase'];
            $id = $input['table'];
            $pwd = '';
            if ($host !== 'localhost') {
                $pwd = 'clvohama';
            }
            // Ajoutez un message de débogage pour vérifier les informations de connexion
            error_log("Connexion à la base de données avec host=$host, db=$db");

            $con = creat_cnx($host, 'root', $pwd, $db);
            if ($con) {
                getData($con, 'client', $id);
            } else {
                echo "Erreur : Impossible de se connecter à la base de données";
            }
        } else {
            echo "Erreur : Données JSON invalides";
        }
    } else {
        echo "Erreur : Méthode de requête non supportée";
    }
}

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

function getData($con, $table, $vcode)
{
    try {
        $stmt = $con->prepare("SELECT * FROM $table WHERE code_ = ?");
        if ($stmt === false) {
            throw new Exception('Préparation de la requête échouée: ' . $con->error);
        }

        $stmt->bind_param("i", $vcode);

        $con->begin_transaction();
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $con->commit();
        $stmt->close();

        // Ajoutez un message de débogage pour les données récupérées
        error_log('Données récupérées: ' . json_encode($data));

        echo json_encode($data);
    } catch (Exception $e) {
        $con->rollback();
        // Ajoutez un message de débogage pour l'erreur
        error_log('Erreur: ' . $e->getMessage());
        echo "Error: " . $e->getMessage();
    }
}
