<?php
require_once __DIR__ . '/../models/Departamento.php';

class DepartamentoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Departamento();
    }

    public function index()
    {
        $departamentos = $this->model->obtenerTodos();
        require_once __DIR__ . '/../views/departamentos/index.php';
    }

    public function crear()
    {
        require_once __DIR__ . '/../views/departamentos/crear.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $ubicacion = $_POST['ubicacion'] ?? '';

            if ($nombre && $ubicacion) {
                $guardado = $this->model->crear($nombre, $ubicacion);  // Cambiado aquí

                if ($guardado) {
                    header('Location: index.php?controller=Departamento&action=index&msg=guardado');
                    exit;
                } else {
                    $error = "Error al guardar el departamento.";
                    require_once __DIR__ . '/../views/departamento/crear.php';
                }
            } else {
                $error = "Complete todos los campos.";
                require_once __DIR__ . '/../views/departamento/crear.php';
            }
        } else {
            header('Location: index.php?controller=Departamento&action=index');
            exit;
        }
    }

    public function editar()
    {
        $id = $_GET['id'];
        $departamento = $this->model->obtenerPorId($id);
        require_once __DIR__ . '/../views/departamentos/editar.php';
    }

    public function actualizar()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $this->model->actualizar($id, $nombre);
        header("Location: index.php?controller=Departamento&action=index");
    }

    public function eliminar()
    {
        $id = $_GET['id'];
        $this->model->eliminar($id);
        header("Location: index.php?controller=Departamento&action=index");
    }
}
