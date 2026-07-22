<?php

namespace App\Services;

use App\Core\Config;

class NowPaymentsService {
    private $apiKey;
    private $ipnSecret;
    private $baseUrl;

    public function __construct() {
        $this->apiKey = Config::get('NOWPAYMENTS_API_KEY');
        $this->ipnSecret = Config::get('NOWPAYMENTS_IPN_SECRET');
        $env = Config::get('NOWPAYMENTS_ENV', 'live');
        $this->baseUrl = ($env === 'sandbox') ? 'https://api.sandbox.nowpayments.io/v1' : 'https://api.nowpayments.io/v1';
    }

    public function createInvoice($amountUsd, $description = 'Payment') {
        $data = [
            'price_amount' => $amountUsd,
            'price_currency' => 'usd',
            'order_description' => $description,
            'ipn_callback_url' => (defined('BASE_URL') ? BASE_URL : Config::get('APP_URL')) . '/api/webhook',
            'success_url' => (defined('BASE_URL') ? BASE_URL : Config::get('APP_URL')) . '/success',
            'cancel_url' => (defined('BASE_URL') ? BASE_URL : Config::get('APP_URL')) . '/'
        ];

        return $this->request('POST', '/invoice', $data);
    }

    public function verifyWebhook($payload, $signature) {
        if (!$this->ipnSecret) return false;

        $request_data = json_decode($payload, true);
        if (!is_array($request_data)) return false;

        ksort($request_data);
        $sorted_request_json = json_encode($request_data, JSON_UNESCAPED_SLASHES);
        
        $hmac = hash_hmac("sha512", $sorted_request_json, trim($this->ipnSecret));
        
        return hash_equals($hmac, $signature);
    }

    private function request($method, $endpoint, $data = null) {
        $ch = curl_init($this->baseUrl . $endpoint);
        
        $headers = [
            'x-api-key: ' . $this->apiKey,
            'Content-Type: application/json',
            'Accept: application/json'
        ];

        $logFile = __DIR__ . '/../../api_error.log';

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($httpCode >= 200 && $httpCode < 300) {
            return json_decode($response, true);
        }

        // Log the actual error to api_error.log
        $errorMsg = "[" . date('Y-m-d H:i:s') . "] NowPayments API Error (HTTP $httpCode): " . ($response ?: "Empty Response");
        if ($curlError) $errorMsg .= " | cURL Error: " . $curlError;
        file_put_contents($logFile, $errorMsg . PHP_EOL, FILE_APPEND);

        $parsedResponse = json_decode($response, true);
        $friendlyError = $parsedResponse['message'] ?? $curlError ?? "Unknown Error (HTTP $httpCode)";
        throw new \Exception($friendlyError);
    }
}
