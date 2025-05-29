<?php
session_start();

// Definir el controlador y acción por defecto
$controller = $_GET['controller'] ?? 'Auth';
$action = $_GET['action'] ?? 'login_form';

// Ruta al archivo del controlador
$controllerFile = __DIR__ . '/../app/controllers/' . $controller . 'Controller.php';

// Verificar si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Crear el nombre de la clase del controlador
    $controllerName = $controller . 'Controller';

    // Verificar si la clase existe
    if (class_exists($controllerName)) {
        $obj = new $controllerName();

        // Verificar si el método (acción) existe en el controlador
        if (method_exists($obj, $action)) {
            // Ejecutar la acción
            $obj->$action();
        } else {
            echo "⚠️ Acción '$action' no encontrada en el controlador '$controllerName'.";
        }
    } else {
        echo "❌ Clase de controlador '$controllerName' no encontrada.";
    }
} else {
    echo "❌ Archivo del controlador '$controllerFile' no encontrado.";
}
