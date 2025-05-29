<?php
require_once __DIR__ . '/../models/Contrato.php';
require_once __DIR__ . '/../models/Empleado.php';

class ContratoController
{
    private $contratoModel;
    private $empleadoModel;

    public function __construct()
    {
        $this->contratoModel = new Contrato();
        $this->empleadoModel = new Empleado();
    }

    public function index()
    {
        $contratos = $this->contratoModel->obtenerTodos();
        require_once __DIR__ . '/../views/admin/contratos/index.php';
    }

    public function crear()
    {
        $empleados = $this->empleadoModel->obtenerTodos();
        require_once __DIR__ . '/../views/admin/contratos/crear.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'empleado_id' => $_POST['empleado_id'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin'],
                'salario_base' => $_POST['salario_base'],
                'departamento' => $_POST['departamento']
            ];

            $this->contratoModel->crear($data);
            header('Location: ../public/index.php?controller=Contrato&action=index');
            exit;
        }
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $contrato = $this->contratoModel->obtenerPorId($id);
            $empleados = $this->empleadoModel->obtenerTodos();
            require_once __DIR__ . '/../views/admin/contratos/editar.php';
        } else {
            header('Location: ../public/index.php?controller=Contrato&action=index');
            exit;
        }
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'empleado_id' => $_POST['empleado_id'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin'],
                'salario_base' => $_POST['salario_base'],
                'departamento' => $_POST['departamento']
            ];
            $this->contratoModel->actualizar($id, $data);
            header('Location: ../public/index.php?controller=Contrato&action=index');
            exit;
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->contratoModel->eliminar($id);
        }
        header('Location: ../public/index.php?controller=Contrato&action=index');
        exit;
    }
}
