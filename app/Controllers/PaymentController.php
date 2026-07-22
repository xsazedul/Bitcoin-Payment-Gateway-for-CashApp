<?php

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Services\NowPaymentsService;
use PDO;

class PaymentController {
    private $db;
    private $nowpayments;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->nowpayments = new NowPaymentsService();
    }

    public function index() {
        View::render('home', ['title' => 'Lightning Pay - Send Bitcoin Instantly']);
    }

    public function success() {
        View::render('success', ['title' => 'Payment Successful']);
    }

    public function create() {
        $amount = (float)($_POST['amount'] ?? 0);
        if ($amount <= 0) {
            header('Location: ' . BASE_URL . '/?error=Invalid amount');
            exit;
        }

        try {
            $invoice = $this->nowpayments->createInvoice($amount, "Payment for services");

            if ($invoice && isset($invoice['invoice_url'])) {
                $stmt = $this->db->prepare("INSERT INTO invoices (invoice_id, amount_usd, amount_sats, payment_url, status, expires_at) VALUES (?, ?, ?, ?, ?, ?)");
                
                $expiresAt = date('Y-m-d H:i:s', time() + (60 * 60 * 24)); // 24 hours
                
                $stmt->execute([
                    $invoice['id'],
                    $amount,
                    0, 
                    $invoice['invoice_url'],
                    'waiting',
                    $expiresAt
                ]);

                // Redirect directly to NowPayments checkout page
                header('Location: ' . $invoice['invoice_url']);
                exit;
            }
        } catch (\Exception $e) {
            header('Location: ' . BASE_URL . '/?error=' . urlencode($e->getMessage()));
            exit;
        }

        header('Location: ' . BASE_URL . '/?error=Failed to create invoice');
    }

    public function webhook() {
        $payload = file_get_contents('php://input');
        $signature = $_SERVER['HTTP_X_NOWPAYMENTS_SIG'] ?? '';

        if ($this->nowpayments->verifyWebhook($payload, $signature)) {
            $data = json_decode($payload, true);
            
            $id = $data['invoice_id'] ?? null;
            $status = $data['payment_status'] ?? null;

            if ($id && $status === 'finished') {
                $stmt = $this->db->prepare("UPDATE invoices SET status = 'finished' WHERE invoice_id = ?");
                $stmt->execute([$id]);

                // Record payment
                $stmt = $this->db->prepare("INSERT IGNORE INTO payments (invoice_id, amount_paid, payment_method) VALUES (?, ?, ?)");
                $stmt->execute([$id, $data['price_amount'] ?? 0, $data['pay_currency'] ?? 'crypto']);
            }

            http_response_code(200);
            echo "OK";
        } else {
            http_response_code(403);
            echo "Invalid signature";
        }
    }
}
