<?php
// admin/logout.php

// 1. Iniciar la sesión (necesario para poder destruirla)
session_start();

// 2. Destruir todas las variables de sesión (limpiar la memoria)
$_SESSION = array();

// 3. Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Esto destruirá la sesión, y no la información de la sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Finalmente, destruir la sesión en el servidor
session_destroy();

// 5. Redireccionar al usuario al Login
header("Location: login.php");
exit;
?>