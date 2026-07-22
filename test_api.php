<?php
require __DIR__ . '/app/Core/Config.php';
use App\Core\Config;

Config::load(__DIR__ . '/.env');

$apiKey = Config::get('OPENNODE_API_KEY');
$env = Config::get('OPENNODE_ENVIRONMENT', 'dev');
$baseUrl = ($env === 'live') ? 'https://api.opennode.com' : 'https://dev-api.opennode.com';

echo "Testing OpenNode API...\n";
echo "Environment: $env\n";
echo "URL: $baseUrl\n";
echo "Key: " . substr($apiKey, 0, 4) . "..." . substr($apiKey, -4) . "\n\n";

$data = [
    'amount' => 10,
    'currency' => 'USD',
    'description' => 'Test'
];

$ch = curl_init($baseUrl . '/v1/charges');
$headers = [
    'Authorization: ' . $apiKey,
    'Content-Type: application/json',
    'Accept: application/json'
];

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $httpCode\n";
if ($curlError) {
    echo "cURL Error: $curlError\n";
}
echo "Response: $response\n";
