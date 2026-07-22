<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Core\Config;
use PDO;

class AdminController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function login() {
        if (isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        }
        View::render('admin/login', ['title' => 'Admin Login', 'isAdmin' => true]);
    }

    public function auth() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $this->db->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        }

        header('Location: ' . BASE_URL . '/admin/login?error=Invalid credentials');
    }

    public function dashboard() {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        // Stats
        $stats = [
            'total_payments' => $this->db->query("SELECT COUNT(*) FROM payments")->fetchColumn(),
            'total_usd' => $this->db->query("SELECT SUM(amount_usd) FROM invoices WHERE status = 'finished'")->fetchColumn() ?: 0,
            'pending_count' => $this->db->query("SELECT COUNT(*) FROM invoices WHERE status = 'waiting'")->fetchColumn(),
        ];

        // History
        $history = $this->db->query("SELECT * FROM invoices ORDER BY created_at DESC LIMIT 50")->fetchAll();

        View::render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'isAdmin' => true,
            'stats' => $stats,
            'history' => $history
        ]);
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . '/admin/login');
    }
}
