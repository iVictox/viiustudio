<?php
// 1. ACTIVAR REPORTE DE ERRORES TEMPORALMENTE
// Esto te permitirá ver si el fallo es de la base de datos en lugar de una pantalla blanca.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// 2. CONTROLAR ERROR DE CONEXIÓN
try {
    require 'config/db.php';
} catch (Exception $e) {
    // Si falla la conexión, mostramos el error en vez de pantalla blanca
    die("Error Critical de Base de Datos: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Limpieza básica de datos
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Login Exitoso
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_user'] = $user['username'];
            
            // Redirección correcta
            header('Location: index.php');
            exit; // [IMPORTANTE] Detener el script aquí
        } else {
            // Credenciales incorrectas
            header('Location: login.php?error=1');
            exit; // [IMPORTANTE] Detener el script aquí
        }
    } catch (PDOException $e) {
        die("Error en la consulta SQL: " . $e->getMessage());
    }
} else {
    // Si alguien intenta entrar a auth.php sin enviar el formulario (GET), devolverlo al login
    header('Location: login.php');
    exit;
}
?>