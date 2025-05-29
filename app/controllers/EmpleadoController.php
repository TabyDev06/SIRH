<?php
require_once __DIR__ . '/../models/Empleado.php';

class EmpleadoController
{
    private $empleadoModel;

    public function __construct()
    {
        $this->empleadoModel = new Empleado();
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
        require_once __DIR__ . '/../views/empleados/index.php';
    }

    public function crear()
    {
        $this->verificarAdmin();
        require_once __DIR__ . '/../views/empleados/crear.php';
    }

    public function guardar()
    {
        $this->verificarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
            $departamento_id = $_POST['departamento_id'] ?? null;

            // Validar campos obligatorios
            if (!$nombre || !$apellido || !$fecha_nacimiento || !$departamento_id) {
                $error = "Complete todos los campos obligatorios.";
                require_once __DIR__ . '/../views/empleados/crear.php';
                return;
            }

            // Calcular edad
            $edad = $this->calcularEdad($fecha_nacimiento);

            // Manejar subida de foto
            $foto = '';
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
                $foto = $this->guardarFoto($_FILES['foto']);
                if (!$foto) {
                    $error = "Error al subir la foto.";
                    require_once __DIR__ . '/../views/empleados/crear.php';
                    return;
                }
            }

            // Guardar en BD
            $this->empleadoModel->crear($nombre, $apellido, $fecha_nacimiento, $edad, $foto, $departamento_id);

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

        require_once __DIR__ . '/../views/empleados/editar.php';
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
                require_once __DIR__ . '/../views/empleados/editar.php';
                return;
            }

            $edad = $this->calcularEdad($fecha_nacimiento);

            // Foto actual por defecto
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

    // Función para calcular edad a partir de fecha de nacimiento
    private function calcularEdad($fecha_nacimiento)
    {
        $fecha = new DateTime($fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha)->y;
        return $edad;
    }

    // Función para guardar foto en carpeta uploads y devolver ruta relativa
    private function guardarFoto($file)
{
    $permitidos = ['image/jpeg', 'image/png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

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

    // Crear carpeta si no existe
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

}
