<?php
// admin/index.php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require 'config/db.php';

// Consultas para contadores
$leads_count = $pdo->query("SELECT COUNT(*) FROM leads WHERE estado = 'nuevo'")->fetchColumn();
$projects_count = $pdo->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$plans_count = $pdo->query("SELECT COUNT(*) FROM plans WHERE activo = 1")->fetchColumn();

// Últimos leads
$stmt = $pdo->query("SELECT * FROM leads ORDER BY fecha DESC LIMIT 5");
$recent_leads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Viiu Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 p-8 overflow-y-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Resumen General</h1>
                <p class="text-slate-500 text-sm">Bienvenido de nuevo, <strong><?php echo $_SESSION['admin_user']; ?></strong></p>
            </div>
            <div class="hidden md:block">
                 <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full border border-blue-200">
                    <?php echo date('d M, Y'); ?>
                 </span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-xs uppercase font-bold tracking-wider mb-1">Leads Nuevos</div>
                    <div class="text-3xl font-bold text-slate-800"><?php echo $leads_count; ?></div>
                </div>
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-xs uppercase font-bold tracking-wider mb-1">Proyectos</div>
                    <div class="text-3xl font-bold text-slate-800"><?php echo $projects_count; ?></div>
                </div>
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex items-center justify-between">
                <div>
                    <div class="text-slate-500 text-xs uppercase font-bold tracking-wider mb-1">Planes Activos</div>
                    <div class="text-3xl font-bold text-slate-800"><?php echo $plans_count; ?></div>
                </div>
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-xl">
                    <i class="fas fa-tag"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-700">Últimas Solicitudes</h3>
                <a href="solicitudes.php" class="text-blue-600 text-sm hover:underline font-medium">Gestionar Todo</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Interés</th>
                            <th class="px-6 py-3">Contacto</th>
                            <th class="px-6 py-3">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($recent_leads as $lead): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-500"><?php echo date('d/m - H:i', strtotime($lead['fecha'])); ?></td>
                            <td class="px-6 py-4 font-bold text-slate-800"><?php echo htmlspecialchars($lead['nombre']); ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded text-xs font-medium">
                                    <?php echo htmlspecialchars($lead['servicio']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($lead['contacto']); ?></td>
                            <td class="px-6 py-4">
                                <?php if($lead['estado'] == 'nuevo'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-red-50 text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Nuevo
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-green-50 text-green-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Visto
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($recent_leads)): ?>
                            <tr><td colspan="5" class="px-6 py-8 text-center text-slate-400">Sin actividad reciente.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>