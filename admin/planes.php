<?php
// admin/planes.php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require 'config/db.php';

$mensaje = '';

// --- LÓGICA POST (Guardar/Editar/Eliminar) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // 1. ELIMINAR
        if ($_POST['action'] === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM plans WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $mensaje = 'Plan eliminado correctamente.';
        }
        // 2. GUARDAR (Crear o Editar)
        elseif ($_POST['action'] === 'save') {
            $titulo = $_POST['titulo'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            // Convertir textarea (una línea por feature) a JSON
            $featuresArray = array_filter(explode("\n", str_replace("\r", "", $_POST['features'])));
            $featuresJson = json_encode(array_values($featuresArray), JSON_UNESCAPED_UNICODE);
            
            $destacado = isset($_POST['destacado']) ? 1 : 0;
            $activo = isset($_POST['activo']) ? 1 : 0;

            if (!empty($_POST['id'])) {
                // Update
                $sql = "UPDATE plans SET titulo=?, precio=?, categoria=?, features=?, destacado=?, activo=? WHERE id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $precio, $categoria, $featuresJson, $destacado, $activo, $_POST['id']]);
                $mensaje = 'Plan actualizado correctamente.';
            } else {
                // Insert
                $sql = "INSERT INTO plans (titulo, precio, categoria, features, destacado, activo) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $precio, $categoria, $featuresJson, $destacado, $activo]);
                $mensaje = 'Nuevo plan creado correctamente.';
            }
        }
    }
}

// Obtener plan para editar si hay ID en GET
$editPlan = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editPlan = $stmt->fetch();
}

// Obtener todos los planes
$planes = $pdo->query("SELECT * FROM plans ORDER BY categoria DESC, precio ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Planes | Viiu Panel</title>
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
                <h1 class="text-3xl font-bold text-slate-800">Planes y Precios</h1>
                <p class="text-slate-500 text-sm">Administra la oferta comercial de tu sitio web.</p>
            </div>
            <?php if($editPlan): ?>
                <a href="planes.php" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition">Cancelar Edición</a>
            <?php endif; ?>
        </header>

        <?php if($mensaje): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 sticky top-4">
                    <h3 class="font-bold text-lg mb-4 text-slate-700 border-b pb-2">
                        <?php echo $editPlan ? 'Editar Plan' : 'Crear Nuevo Plan'; ?>
                    </h3>
                    <form method="POST" action="planes.php">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="id" value="<?php echo $editPlan['id'] ?? ''; ?>">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Título del Plan</label>
                                <input type="text" name="titulo" required value="<?php echo $editPlan['titulo'] ?? ''; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Precio ($)</label>
                                    <input type="number" step="0.01" name="precio" required value="<?php echo $editPlan['precio'] ?? ''; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Categoría</label>
                                    <select name="categoria" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                        <?php $cat = $editPlan['categoria'] ?? ''; ?>
                                        <option value="web" <?php echo $cat == 'web' ? 'selected' : ''; ?>>Web Dev</option>
                                        <option value="sistemas" <?php echo $cat == 'sistemas' ? 'selected' : ''; ?>>Sistemas (SaaS)</option>
                                        <option value="automatizacion" <?php echo $cat == 'automatizacion' ? 'selected' : ''; ?>>Automatización</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Características (Una por línea)</label>
                                <textarea name="features" rows="6" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm font-mono placeholder-slate-400" placeholder="Dominio Gratis&#10;SSL Incluido&#10;Soporte 24/7"><?php 
                                    if ($editPlan && $editPlan['features']) {
                                        $feats = json_decode($editPlan['features'], true);
                                        if(is_array($feats)) echo implode("\n", $feats);
                                    }
                                ?></textarea>
                            </div>

                            <div class="flex items-center gap-4 pt-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="destacado" class="sr-only peer" <?php echo ($editPlan['destacado'] ?? 0) ? 'checked' : ''; ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-400 relative"></div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Destacado</span>
                                </label>

                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="activo" class="sr-only peer" <?php echo ($editPlan['activo'] ?? 1) ? 'checked' : ''; ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 relative"></div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Activo</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-blue-900/20">
                                <?php echo $editPlan ? 'Actualizar Plan' : 'Guardar Plan'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="xl:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-3">Plan</th>
                                <th class="px-6 py-3">Precio</th>
                                <th class="px-6 py-3">Estado</th>
                                <th class="px-6 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach($planes as $plan): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800"><?php echo htmlspecialchars($plan['titulo']); ?></div>
                                    <div class="text-xs text-slate-400 uppercase"><?php echo $plan['categoria']; ?></div>
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-700">$<?php echo $plan['precio']; ?></td>
                                <td class="px-6 py-4">
                                    <?php if($plan['activo']): ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Activo</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Inactivo</span>
                                    <?php endif; ?>
                                    
                                    <?php if($plan['destacado']): ?>
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-star mr-1"></i> Top</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="planes.php?edit=<?php echo $plan['id']; ?>" class="text-blue-600 hover:text-blue-800 font-medium">Editar</a>
                                    <form method="POST" action="planes.php" class="inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este plan?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>