<?php
session_start();
$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'login_form';

$controllerFile = __DIR__ . '/../app/controllers/' . $controller . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    $controllerName = $controller . 'Controller';

    if (class_exists($controllerName)) {
        $obj = new $controllerName();

        if (method_exists($obj, $action)) {
            $obj->$action();
        } else {
            echo "Acción '$action' no encontrada en el controlador '$controllerName'.";
        }
    } else {
        echo "Controlador '$controllerName' no encontrado.";
    }
} else {
    echo "Archivo del controlador '$controllerFile' no encontrado.";
}
