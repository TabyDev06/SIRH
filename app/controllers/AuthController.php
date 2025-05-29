<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    private $usuarioModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->usuarioModel = new Usuario();
        error_log("AuthController inicializado");
    }

    public function login_form($error = null)
    {
        error_log("Mostrando formulario de login");
        require_once __DIR__ . '/../views/login.php';
    }

    public function login()
    {
        error_log("Método login() llamado");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("Método POST detectado");

            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            error_log("Datos recibidos - Correo: $correo");

            if (filter_var($correo, FILTER_VALIDATE_EMAIL) && $contrasena) {
                $user = $this->usuarioModel->obtenerPorCorreo($correo);
                error_log("Usuario obtenido: " . json_encode($user));

                if ($user && password_verify($contrasena, $user['contrasena'])) {
                    error_log("Contraseña verificada con éxito");

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['correo'] = $user['correo'];
                    $_SESSION['rol'] = $user['rol'];

                    error_log("Rol del usuario: " . $user['rol']);

                    if ($user['rol'] === 'Administrador') {
                        header('Location: index.php?controller=Auth&action=dashboard');
                        exit;
                    } elseif ($user['rol'] === 'Empleado') {
                        header('Location: index.php?controller=Empleado&action=listaParaEmpleado');
                        exit;
                    } else {
                        error_log("Rol no reconocido");
                        $error = "Rol de usuario no válido.";
                        $this->login_form($error);
                    }
                } else {
                    error_log("Correo o contraseña incorrectos");
                    $error = "Correo o contraseña incorrectos.";
                    $this->login_form($error);
                }
            } else {
                error_log("Campos incompletos o correo inválido");
                $error = "Complete todos los campos correctamente.";
                $this->login_form($error);
            }
        } else {
            error_log("No es método POST. Redirigiendo al index.");
            header('Location: ../public/index.php');
            exit;
        }
    }

    public function logout()
    {
        error_log("Sesión finalizada");
        session_destroy();
        header('Location: ../public/index.php');
        exit;
    }

    public function dashboard()
    {
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }
}
