<?php
// admin/api/chat.php - VERSIÓN GROQ (Llama 3 - 100% GRATIS Y RÁPIDO)
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Depuración
ini_set('display_errors', 0); 
error_reporting(E_ALL);

// --- CONFIGURACIÓN ---
// [IMPORTANTE] PEGA TU API KEY DE GROQ AQUÍ (Empieza por 'gsk_...')
// Cargar clave secreta
$secretsFile = __DIR__ . '/secrets.php';

if (file_exists($secretsFile)) {
    require_once $secretsFile;
    $apiKey = GROQ_API_KEY;
} else {
    // Fallback por si olvidas crear el archivo en producción
    $apiKey = getenv('GROQ_API_KEY'); 
}

if ($apiKey === 'TU_API_KEY_DE_GROQ_AQUI' || empty($apiKey)) {
    echo json_encode(['reply' => 'Error: Falta la API Key de Groq.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Mensaje vacío.']);
    exit;
}

// --- CEREBRO DEL BOT ---
$systemPrompt = "
Eres 'ViiuBot', el asistente de la agencia 'Viiu Studio'.
Objetivo: Vender desarrollo web y sistemas.
Estilo: Muy amable, usa emojis, respuestas cortas y directas.

PRECIOS (VE):
1. WEB: Landing ($19), Corp ($35), E-Commerce ($60).
2. SISTEMAS: Básico ($40), ERP ($80).
3. BOTS: Atención ($25).

PROMOS: 3 Meses (5%), 6 Meses (10%), 1 Año (15%).

SI PIDEN CONTACTO:
WhatsApp: +58 412 77 03302.
";

// --- PETICIÓN A GROQ ---
$url = "https://api.groq.com/openai/v1/chat/completions";

$data = [
    "model" => "llama-3.3-70b-versatile", // Modelo gratuito, inteligente y rápido
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => $userMessage]
    ],
    "temperature" => 0.6,
    "max_tokens" => 300
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

// Fix SSL Local
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$result = curl_exec($ch);

if(curl_errno($ch)){
    echo json_encode(['reply' => 'Error conexión: ' . curl_error($ch)]);
} else {
    $response = json_decode($result, true);
    
    if (isset($response['error'])) {
        echo json_encode(['reply' => 'Error Groq: ' . $response['error']['message']]);
    } else {
        $botReply = $response['choices'][0]['message']['content'] ?? 'No entendí.';
        echo json_encode(['reply' => $botReply]);
    }
}

curl_close($ch);
?>