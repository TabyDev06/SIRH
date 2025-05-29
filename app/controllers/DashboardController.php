<?php
    class DashboardController
    {
        public function index()
        {
            $this->dashboard();
        }

        public function dashboard()
        {
            if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'Administrador') {
                header('Location: ../public/index.php?controller=Auth&action=login_form');
                exit;
            }
            require_once __DIR__ . '/../views/admin/dashboard.php';
        }
    }