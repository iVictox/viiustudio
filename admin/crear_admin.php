<?php
// crear_admin.php (EJECUTAR UNA VEZ Y BORRAR)
require 'config/db.php';
$pass = password_hash('pZv.D4ñL6<v1C6i<y\>', PASSWORD_DEFAULT); 
$sql = "INSERT INTO admin_users (username, password) VALUES ('victox', '$pass')";
$pdo->query($sql);
echo "Usuario creado. Contraseña hasheada: " . $pass;
?>