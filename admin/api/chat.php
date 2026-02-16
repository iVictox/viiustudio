<?php
// admin/api/chat.php - VERSIÓN ROBUSTA CON CURL
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// 1. ACTIVAR REPORTES DE ERROR (Solo para depuración, quítalo en producción real)
ini_set('display_errors', 0); 
error_reporting(E_ALL);

// --- CONFIGURACIÓN ---
// [IMPORTANTE] ¡ASEGÚRATE DE PEGAR TU API KEY AQUÍ!
$apiKey = 'AIzaSyB0PNQj1cxZriuOCNBhlinShVgEumlbB3M'; 

// Verificar que la API Key no esté vacía
if ($apiKey === 'TU_API_KEY_AQUI' || empty($apiKey)) {
    echo json_encode(['reply' => 'Error de Configuración: Falta la API Key en chat.php']);
    exit;
}

// Leer entrada
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'El mensaje llegó vacío.']);
    exit;
}

// --- CONTEXTO DEL NEGOCIO ---
$systemPrompt = "
Eres 'ViiuBot', el asistente virtual de la agencia 'Viiu Studio'.
Objetivo: Vender desarrollo web, sistemas y automatización.
Estilo: Breve, profesional y persuasivo. Usa emojis.

TUS DATOS:
1. WEB: Landing ($19), Corporativa ($35), E-Commerce ($60).
2. SISTEMAS: Básico ($40), ERP ($80).
3. BOTS: Atención ($25), Flujos ($55).

DESCUENTOS (PAGO ADELANTADO):
- 3 Meses: 5% OFF
- 6 Meses: 10% OFF
- 1 Año: 15% OFF

CONTACTO:
WhatsApp: +58 412 77 03302.
";

// --- PETICIÓN A GOOGLE GEMINI USANDO CURL ---
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => $systemPrompt . "\n\nConsulta del Cliente: " . $userMessage]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7,
        "maxOutputTokens" => 300
    ]
];

// Inicializar cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// [FIX] Solución para errores de certificado SSL en Localhost (XAMPP/WAMP)
// En producción real, esto debería ser true, pero en local suele dar error.
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if(curl_errno($ch)){
    // Error de conexión (DNS, Red, etc)
    echo json_encode(['reply' => 'Error Interno (cURL): ' . curl_error($ch)]);
} else {
    // Procesar respuesta
    $response = json_decode($result, true);
    
    if ($httpCode !== 200) {
        // Error de la API de Google (ej. Key inválida)
        $errorMsg = $response['error']['message'] ?? 'Error desconocido de Google API';
        echo json_encode(['reply' => 'Error API Google: ' . $errorMsg]);
    } else {
        // Éxito
        $botReply = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No supe qué responder.';
        echo json_encode(['reply' => $botReply]);
    }
}

curl_close($ch);
?>