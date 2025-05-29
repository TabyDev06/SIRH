<?php
require_once __DIR__ . '/../models/Empleado.php';
require_once __DIR__ . '/../models/Departamento.php';

class EmpleadoController
{
    private $empleadoModel;

    public function __construct()
    {
        $this->empleadoModel = new Empleado();
    }

    public function perfil()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Empleado') {
            header('Location: ../public/index.php?controller=Auth&action=login_form');
            exit;
        }

        $id = $_SESSION['user_id'];

        $empleado = $this->empleadoModel->obtenerPorId($id);

        if (!$empleado) {
            die('Empleado no encontrado.');
        }

        require_once __DIR__ . '/../views/empleados/perfil.php';
    }

    private function verificarAdmin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: ../public/index.php?controller=Auth&action=login_form');
            exit;
        }
    }

    public function index()
    {
        $this->verificarAdmin();

        $empleados = $this->empleadoModel->obtenerTodos();
        require_once __DIR__ . '/../views/admin/empleados/index.php';
    }

    public function crear()
    {
        $this->verificarAdmin();

        $departamentoModel = new Departamento();
        $departamentos = $departamentoModel->obtenerTodos();

        require_once __DIR__ . '/../views/admin/empleados/crear.php';
    }

    public function guardar()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $departamento_id = $_POST['departamento_id'] ?? null;
            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';
            $rol = $_POST['rol'] ?? '';

            // Validar campos obligatorios
            if (!$nombre || !$apellido || !$fecha_nacimiento || !$departamento_id || !$correo || !$contrasena || !$rol) {
                $error = "Complete todos los campos obligatorios.";
                $departamentoModel = new Departamento();
                $departamentos = $departamentoModel->obtenerTodos();
                require_once __DIR__ . '/../views/admin/empleados/crear.php';
                return;
            }

            // Validar correo
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $error = "Correo inválido.";
                $departamentoModel = new Departamento();
                $departamentos = $departamentoModel->obtenerTodos();
                require_once __DIR__ . '/../views/admin/empleados/crear.php';
                return;
            }

            $edad = $this->calcularEdad($fecha_nacimiento);

            $foto = '';
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $foto = $this->guardarFoto($_FILES['foto']);
                if (!$foto) {
                    $error = "Error al subir la foto.";
                    $departamentoModel = new Departamento();
                    $departamentos = $departamentoModel->obtenerTodos();
                    require_once __DIR__ . '/../views/admin/empleados/crear.php';
                    return;
                }
            }

            // Insertar empleado y obtener último ID insertado
            $this->empleadoModel->crear($nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id);
            $empleadoId = $this->empleadoModel->getUltimoIdInsertado();

            // Insertar usuario con validación de correo duplicado
            require_once __DIR__ . '/../models/Usuario.php';
            $usuarioModel = new Usuario();

            $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            $resultadoUsuario = $usuarioModel->crear($empleadoId, $correo, $hashContrasena, $rol);

            if (!$resultadoUsuario) {
                // Si el correo ya existe, eliminar el empleado creado para no quedar inconsistente
                $this->empleadoModel->eliminar($empleadoId);

                $error = "El correo electrónico ya está registrado.";
                $departamentoModel = new Departamento();
                $departamentos = $departamentoModel->obtenerTodos();

                // Mostrar formulario con error
                require_once __DIR__ . '/../views/admin/empleados/crear.php';
                return;
            }

            header('Location: ../public/index.php?controller=Empleado&action=index');
            exit;
        } else {
            header('Location: ../public/index.php?controller=Empleado&action=crear');
            exit;
        }
    }

    public function editar()
    {
        $this->verificarAdmin();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ../public/index.php?controller=Empleado&action=index');
            exit;
        }

        $empleado = $this->empleadoModel->obtenerPorId($id);
        if (!$empleado) {
            header('Location: ../public/index.php?controller=Empleado&action=index');
            exit;
        }

        $departamentoModel = new Departamento();
        $departamentos = $departamentoModel->obtenerTodos();

        require_once __DIR__ . '/../views/admin/empleados/editar.php';
    }

    public function actualizar()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $departamento_id = $_POST['departamento_id'] ?? null;

            if (!$id || !$nombre || !$apellido || !$fecha_nacimiento || !$departamento_id) {
                $error = "Complete todos los campos obligatorios.";
                $empleado = $this->empleadoModel->obtenerPorId($id);

                $departamentoModel = new Departamento();
                $departamentos = $departamentoModel->obtenerTodos();

                require_once __DIR__ . '/../views/empleados/editar.php';
                return;
            }

            $edad = $this->calcularEdad($fecha_nacimiento);

            $empleadoActual = $this->empleadoModel->obtenerPorId($id);
            $foto = $empleadoActual['foto'] ?? '';

            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $fotoNueva = $this->guardarFoto($_FILES['foto']);
                if ($fotoNueva) {
                    $foto = $fotoNueva;
                }
            }

            $this->empleadoModel->actualizar($id, $nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id);

            header('Location: ../public/index.php?controller=Empleado&action=index');
            exit;
        } else {
            header('Location: ../public/index.php?controller=Empleado&action=index');
            exit;
        }
    }

    public function eliminar()
    {
        $this->verificarAdmin();

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->empleadoModel->eliminar($id);
        }

        header('Location: ../public/index.php?controller=Empleado&action=index');
        exit;
    }

    private function calcularEdad($fecha_nacimiento)
    {
        $fecha = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        return $hoy->diff($fecha)->y;
    }

    private function guardarFoto($file)
    {
        $permitidos = ['image/jpeg', 'image/png'];
        $maxSize = 2 * 1024 * 1024;

        if (!in_array($file['type'], $permitidos)) {
            echo "Tipo de archivo no permitido.";
            return false;
        }

        if ($file['size'] > $maxSize) {
            echo "Archivo demasiado grande.";
            return false;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nombreArchivo = uniqid() . '.' . $ext;

        $uploadDir = __DIR__ . '/../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $rutaDestino = $uploadDir . $nombreArchivo;

        if (move_uploaded_file($file['tmp_name'], $rutaDestino)) {
            return 'uploads/' . $nombreArchivo;
        } else {
            echo "No se pudo mover el archivo subido.";
            return false;
        }
    }

    public function ver()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Empleado') {
            header('Location: ../public/index.php?controller=Auth&action=login_form');
            exit;
        }

        $id = $_SESSION['user_id'];
        $empleado = $this->empleadoModel->obtenerPorId($id);

        if (!$empleado) {
            die('Empleado no encontrado.');
        }

        require_once __DIR__ . '/../views/empleado/perfil.php';
    }

    public function listaParaEmpleado()
{
    if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Empleado') {
        header('Location: ../public/index.php?controller=Auth&action=login_form');
        exit;
    }

    $empleados = $this->empleadoModel->obtenerTodos();
    require_once __DIR__ . '/../views/empleado/index.php';
}


}
