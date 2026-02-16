<?php
// admin/api/chat.php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// --- CONFIGURACIÓN ---
// ¡PEGA AQUÍ TU API KEY DE GOOGLE AI STUDIO!
$apiKey = 'AIzaSyB0PNQj1cxZriuOCNBhlinShVgEumlbB3M'; 

$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Por favor escribe algo.']);
    exit;
}

// --- CONTEXTO DEL NEGOCIO (EL CEREBRO DEL BOT) ---
// Aquí "inyectamos" tus precios y servicios actualizados para que la IA los sepa.
$systemPrompt = "
Eres 'ViiuBot', el asistente virtual experto de la agencia de desarrollo 'Viiu Studio'.
Tu objetivo es vender servicios de desarrollo web, sistemas y automatización.
Responde de forma corta, profesional, persuasiva y amable (máximo 3 párrafos).
Usa emojis moderadamente.
Si te preguntan precios, sé claro y menciona los descuentos por pago adelantado.

TUS DATOS Y PRECIOS ACTUALIZADOS:

1. DESARROLLO WEB:
- Landing Page: Desde $19/mes (Instalación Gratis).
- Web Corporativa: Desde $35/mes (Instalación $20).
- E-Commerce: Desde $60/mes (Instalación $50).

2. SISTEMAS SAAS (Software Administrativo):
- Gestión Básica: Desde $40/mes (Instalación $25).
- ERP / CRM: Desde $80/mes (Instalación $60).

3. AUTOMATIZACIÓN (Bots):
- Bot de Atención: Desde $25/mes (Instalación $10).
- Flujos de Negocio: Desde $55/mes (Instalación $30).

DESCUENTOS POR PAGO ADELANTADO (IMPORTANTE MENCIONAR):
- 3 Meses: 5% de descuento.
- 6 Meses: 10% de descuento.
- 1 Año: 15% de descuento.

CONTACTO HUMANO:
Si el cliente quiere contratar o una reunión, diles que escriban al WhatsApp: +58 412 77 03302.
";

// --- LLAMADA A LA API DE GEMINI ---
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => $systemPrompt . "\n\nCliente dice: " . $userMessage]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7,
        "maxOutputTokens" => 300
    ]
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    ]
];

$context  = stream_context_create($options);

try {
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    
    // Extraer respuesta de Gemini
    $botReply = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'Lo siento, tuve un error de conexión. Escríbenos al WhatsApp.';
    
    echo json_encode(['reply' => $botReply]);

} catch (Exception $e) {
    echo json_encode(['reply' => 'Error del servidor. Intenta más tarde.']);
}
?>