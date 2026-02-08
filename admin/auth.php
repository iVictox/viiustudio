<?php
// admin/auth.php - MODO DIAGNÓSTICO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

echo "<h1>Diagnóstico de Login</h1>";

// 1. Verificar datos recibidos
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("❌ Error: Debes enviar el formulario desde login.php, no abrir este archivo directo.");
}

$user_input = $_POST['username'] ?? 'VACIO';
$pass_input = $_POST['password'] ?? 'VACIO';

echo "1. Datos recibidos: Usuario = [" . htmlspecialchars($user_input) . "] / Pass = [" . htmlspecialchars($pass_input) . "]<br>";

// 2. Probar conexión
require 'config/db.php';
if ($pdo) {
    echo "2. Conexión a Base de Datos: ✅ EXITOSA<br>";
} else {
    die("2. Conexión a Base de Datos: ❌ FALLÓ");
}

// 3. Buscar usuario
$stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
$stmt->execute([$user_input]);
$usuario_db = $stmt->fetch();

if (!$usuario_db) {
    echo "3. Búsqueda de usuario: ❌ NO ENCONTRADO en la tabla 'admin_users'.<br>";
    echo "👉 <strong>Solución:</strong> Ejecuta /admin/crear_admin.php en tu navegador.";
    exit;
} else {
    echo "3. Búsqueda de usuario: ✅ Usuario encontrado (ID: " . $usuario_db['id'] . ")<br>";
}

// 4. Verificar contraseña
if (password_verify($pass_input, $usuario_db['password'])) {
    echo "4. Verificación de contraseña: ✅ CORRECTA<br>";
    
    // Prueba de sesión
    $_SESSION['test_session'] = 'funciona';
    if(isset($_SESSION['test_session'])) {
        echo "5. Sistema de Sesiones: ✅ FUNCIONANDO<br>";
        echo "<br><strong>¡TODO ESTÁ BIEN!</strong><br>";
        echo "Si ves esto, el problema era solo la redirección o la contraseña incorrecta.<br>";
        echo "<a href='index.php'>Haz clic aquí para entrar al Panel manualmente</a>";
    } else {
        echo "5. Sistema de Sesiones: ❌ FALLANDO (El servidor no guarda las sesiones)";
    }
    
} else {
    echo "4. Verificación de contraseña: ❌ INCORRECTA<br>";
    echo "Hash en DB: " . substr($usuario_db['password'], 0, 10) . "...<br>";
    echo "👉 Revisa mayúsculas/minúsculas o espacios extra.";
}
?>