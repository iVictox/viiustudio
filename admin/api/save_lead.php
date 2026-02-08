<?php
header('Content-Type: application/json');

// IMPORTANTE: Ajustamos la ruta para salir de 'api' y entrar a 'config'
require '../config/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['nombre'])) {
        try {
            $stmt = $pdo->prepare("INSERT INTO leads (nombre, contacto, servicio, mensaje) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $data['nombre'],
                $data['contacto'],
                $data['servicio'],
                $data['mensaje'] ?? ''
            ]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            // Devuelve el error real de la base de datos para que podamos verlo
            echo json_encode(['success' => false, 'error' => 'DB Error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Datos vacíos']);
    }
}
?>