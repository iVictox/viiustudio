<?php
// admin/api/chat.php - VERSIÓN DEEPSEEK (Compatible OpenAI)
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Depuración (Desactivar en producción)
ini_set('display_errors', 0); 
error_reporting(E_ALL);

// --- CONFIGURACIÓN ---
// [IMPORTANTE] PEGA AQUÍ TU API KEY DE DEEPSEEK (Empieza por 'sk-...')
$apiKey = 'sk-3de297810444430d957ce63db58a08c0'; 

if ($apiKey === 'TU_API_KEY_DEEPSEEK_AQUI' || empty($apiKey)) {
    echo json_encode(['reply' => 'Error: Falta la API Key de DeepSeek.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Mensaje vacío.']);
    exit;
}

// --- CEREBRO DEL BOT (System Prompt) ---
$systemPrompt = "
Eres 'ViiuBot', vendedor experto de la agencia 'Viiu Studio'.
Objetivo: Vender desarrollo web, sistemas y automatización.
Estilo: Persuasivo, profesional, usa emojis. Respuestas cortas.

PRECIOS ACTUALIZADOS (VE):
1. WEB: Landing ($19), Corporativa ($35), E-Commerce ($60).
2. SISTEMAS: Básico ($40), ERP ($80).
3. BOTS: Atención ($25), Flujos ($55).

DESCUENTOS PAGO ADELANTADO:
- 3 Meses: 5% | 6 Meses: 10% | 1 Año: 15%

CONTACTO:
WhatsApp: +58 412 77 03302.
";

// --- PETICIÓN A DEEPSEEK ---
$url = "https://api.deepseek.com/chat/completions";

// Estructura estándar tipo OpenAI
$data = [
    "model" => "deepseek-chat", // Modelo V3 (Rápido y barato)
    "messages" => [
        ["role" => "system", "content" => $systemPrompt],
        ["role" => "user", "content" => $userMessage]
    ],
    "temperature" => 0.7,
    "max_tokens" => 300
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey // Aquí va la clave ahora
]);

// Fix SSL Local
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$result = curl_exec($ch);

if(curl_errno($ch)){
    echo json_encode(['reply' => 'Error de conexión: ' . curl_error($ch)]);
} else {
    $response = json_decode($result, true);
    
    // Verificar si hay error en la respuesta de la API
    if (isset($response['error'])) {
        echo json_encode(['reply' => 'Error DeepSeek: ' . $response['error']['message']]);
    } else {
        // La respuesta está en choices -> 0 -> message -> content
        $botReply = $response['choices'][0]['message']['content'] ?? 'No entendí eso.';
        echo json_encode(['reply' => $botReply]);
    }
}

curl_close($ch);
?>