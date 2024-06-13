<?php

// Définir les routes
$routes = array(
    '/' => '../view/test.php',
    '/login' => array('controller' => 'auth_controller', 'action' => 'login'),
    // Ajoutez d'autres routes au besoin
);

// Récupérer le chemin d'information de l'URL demandée
$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$route_found = false;

foreach ($routes as $route => $handler) {
    if ($route === $path_info) {
        $route_found = true;

        // Vérifier si un contrôleur et une action sont définis pour cette route
        if (is_array($handler) && isset($handler['controller']) && isset($handler['action'])) {
            // Inclure le fichier du contrôleur
            include_once('../controller/' . $handler['controller'] . '.php');

            // Créer une instance du contrôleur
            $controller = new $handler['controller']();

            // Appeler l'action sur le contrôleur
            if (method_exists($controller, $handler['action'])) {
                $controller->{$handler['action']}();
            } else {
                // Si l'action n'existe pas, afficher une erreur 404
                http_response_code(404);
                echo 'Error 404 - Action not found';
            }
        } else {
            // Si aucun contrôleur ou action n'est défini, inclure le fichier correspondant
            include_once($handler);
        }

        break;
    }
}

// Si aucune route correspondante n'est trouvée, afficher une erreur 404
if (!$route_found) {
    http_response_code(404);
    echo 'Error 404 - Page not found';
}
