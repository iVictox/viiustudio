<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Viiu Studio Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-900 flex items-center justify-center h-screen">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-2xl w-full max-w-md border border-slate-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Viiu Panel</h1>
            <p class="text-slate-400 text-sm">Acceso Administrativo</p>
        </div>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded mb-4 text-sm text-center">
                Credenciales incorrectas
            </div>
        <?php endif; ?>

        <form action="auth.php" method="POST" class="space-y-6">
            <div>
                <label class="text-slate-300 text-sm font-bold mb-2 block">Usuario</label>
                <input type="text" name="username" required class="w-full bg-slate-900 border border-slate-600 text-white rounded-lg p-3 focus:border-blue-500 outline-none">
            </div>
            <div>
                <label class="text-slate-300 text-sm font-bold mb-2 block">Contraseña</label>
                <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-600 text-white rounded-lg p-3 focus:border-blue-500 outline-none">
            </div>
            <button type="submit" class="w-full bg-blue-700 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-blue-900/50">
                Ingresar al Sistema
            </button>
        </form>
    </div>
</body>
</html>