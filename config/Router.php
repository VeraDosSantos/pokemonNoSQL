<?php

namespace Config;

use App\Controllers\ErrorController;

class Router
{
    private array $routes = [];

    public function getUri()
    {
        // Récupère l'URI de la requête en cours et retourne seulement le chemin
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function addRoute($pattern, $controllerClass, $method)
    {
        $this->routes[$pattern] = [
            'controller' => $controllerClass,
            'method' => $method
        ];
    }

    /**
     * Gère la requête HTTP en fonction de l'URI
     */
    public function handleRequest()
    {
        // Récupère l'URI de la requête actuelle
        $uri = $this->getURI();

        // Indicateur pour savoir si une route correspondante a été trouvée
        $routeFound = false;

        // Parcourt toutes les routes définies
        foreach ($this->routes as $pattern => $routeInfo) {
            // Si l'URI correspond à une route définie
            if ($uri === $pattern) {
                // Route trouvée, on met l'indicateur à vrai
                $routeFound = true;

                // Récupère la classe et la méthode du contrôleur associées à cette route
                $controllerClass = $routeInfo['controller'];
                $method = $routeInfo['method'];

                // Construit le nom complet de la classe avec son espace de noms
                $controllerClass = "App\\Controllers\\" . $controllerClass;

                // Crée une nouvelle instance du contrôleur
                $controller = new $controllerClass();

                // Appelle la méthode associée de ce contrôleur
                $controller->$method();

                // Sort de la boucle car la route a été trouvée
                break;
            }
        }
        // Si aucune route n'a été trouvée, affiche une page d'erreur 404
        if (!$routeFound) {
            echo ErrorController::notFound(); // Affiche la page d'erreur via le contrôleur d'erreurs
            // Option alternative : inclure un fichier PHP pour la page 404
            //require_once(__DIR__ . '/../app/Controllers/404.php');
        }
    }
}
