<?php
// admin/planes.php - VERSIÓN MEJORADA CON SETUP FEE Y DESCUENTOS
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require 'config/db.php';

$mensaje = '';

// --- LÓGICA POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // ELIMINAR
        if ($_POST['action'] === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM plans WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $mensaje = 'Plan eliminado correctamente.';
        }
        // GUARDAR
        elseif ($_POST['action'] === 'save') {
            $titulo = $_POST['titulo'];
            $precio = $_POST['precio'];
            $setup_fee = $_POST['setup_fee']; // NUEVO
            $descuento_anual = $_POST['descuento_anual']; // NUEVO
            $categoria = $_POST['categoria'];
            
            $featuresArray = array_filter(explode("\n", str_replace("\r", "", $_POST['features'])));
            $featuresJson = json_encode(array_values($featuresArray), JSON_UNESCAPED_UNICODE);
            
            $destacado = isset($_POST['destacado']) ? 1 : 0;
            $activo = isset($_POST['activo']) ? 1 : 0;

            if (!empty($_POST['id'])) {
                // UPDATE con nuevos campos
                $sql = "UPDATE plans SET titulo=?, precio=?, setup_fee=?, descuento_anual=?, categoria=?, features=?, destacado=?, activo=? WHERE id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $precio, $setup_fee, $descuento_anual, $categoria, $featuresJson, $destacado, $activo, $_POST['id']]);
                $mensaje = 'Plan actualizado con éxito.';
            } else {
                // INSERT con nuevos campos
                $sql = "INSERT INTO plans (titulo, precio, setup_fee, descuento_anual, categoria, features, destacado, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $precio, $setup_fee, $descuento_anual, $categoria, $featuresJson, $destacado, $activo]);
                $mensaje = 'Nuevo plan estratégico creado.';
            }
        }
    }
}

// Obtener plan para editar
$editPlan = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editPlan = $stmt->fetch();
}

// Obtener todos
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
                <h1 class="text-3xl font-bold text-slate-800">Estrategia Comercial</h1>
                <p class="text-slate-500 text-sm">Define tus precios, cuotas de inicio y ofertas.</p>
            </div>
            <?php if($editPlan): ?>
                <a href="planes.php" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition">Cancelar</a>
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
                        <?php echo $editPlan ? 'Editar Plan' : 'Nuevo Plan'; ?>
                    </h3>
                    <form method="POST" action="planes.php">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="id" value="<?php echo $editPlan['id'] ?? ''; ?>">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Título del Servicio</label>
                                <input type="text" name="titulo" required value="<?php echo $editPlan['titulo'] ?? ''; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-blue-600 mb-1">Mensualidad ($)</label>
                                    <input type="number" step="0.01" name="precio" required value="<?php echo $editPlan['precio'] ?? ''; ?>" class="w-full p-2 border border-blue-200 bg-blue-50 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none font-bold">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-green-600 mb-1">Setup Fee (Inicio) ($)</label>
                                    <input type="number" step="0.01" name="setup_fee" required value="<?php echo $editPlan['setup_fee'] ?? '0.00'; ?>" class="w-full p-2 border border-green-200 bg-green-50 rounded-lg focus:ring-2 focus:ring-green-500 outline-none font-bold">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Categoría</label>
                                    <select name="categoria" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                        <?php $cat = $editPlan['categoria'] ?? ''; ?>
                                        <option value="web" <?php echo $cat == 'web' ? 'selected' : ''; ?>>Web Dev</option>
                                        <option value="sistemas" <?php echo $cat == 'sistemas' ? 'selected' : ''; ?>>Sistemas SaaS</option>
                                        <option value="automatizacion" <?php echo $cat == 'automatizacion' ? 'selected' : ''; ?>>Automatización</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">% Descuento Anual</label>
                                    <input type="number" name="descuento_anual" value="<?php echo $editPlan['descuento_anual'] ?? '0'; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Características (Una por línea)</label>
                                <textarea name="features" rows="6" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm font-mono placeholder-slate-400"><?php 
                                    if ($editPlan && $editPlan['features']) {
                                        $feats = json_decode($editPlan['features'], true);
                                        if(is_array($feats)) echo implode("\n", $feats);
                                    }
                                ?></textarea>
                            </div>

                            <div class="flex items-center gap-4 pt-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="destacado" class="sr-only peer" <?php echo ($editPlan['destacado'] ?? 0) ? 'checked' : ''; ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-yellow-400 relative transition-all">
                                        <div class="absolute top-[2px] left-[2px] bg-white h-5 w-5 rounded-full transition-all peer-checked:translate-x-full"></div>
                                    </div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Destacado</span>
                                </label>

                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="activo" class="sr-only peer" <?php echo ($editPlan['activo'] ?? 1) ? 'checked' : ''; ?>>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:bg-green-500 relative transition-all">
                                        <div class="absolute top-[2px] left-[2px] bg-white h-5 w-5 rounded-full transition-all peer-checked:translate-x-full"></div>
                                    </div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Activo</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors shadow-lg">
                                <?php echo $editPlan ? 'Guardar Cambios' : 'Crear Plan'; ?>
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
                                <th class="px-6 py-3">Estructura de Costos</th>
                                <th class="px-6 py-3 text-center">Estado</th>
                                <th class="px-6 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php foreach($planes as $plan): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800 text-base"><?php echo htmlspecialchars($plan['titulo']); ?></div>
                                    <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-500">
                                        <?php echo $plan['categoria']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <span class="font-mono text-blue-600 font-bold">$<?php echo $plan['precio']; ?> <span class="text-xs text-slate-400 font-sans">/mes</span></span>
                                        <?php if($plan['setup_fee'] > 0): ?>
                                            <span class="text-xs text-green-600 font-bold">+ $<?php echo $plan['setup_fee']; ?> inicio</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if($plan['destacado']): ?>
                                        <div class="text-yellow-500 text-xs mb-1"><i class="fas fa-star"></i> Top</div>
                                    <?php endif; ?>
                                    <?php if($plan['activo']): ?>
                                        <span class="inline-block w-2 h-2 rounded-full bg-green-500" title="Activo"></span>
                                    <?php else: ?>
                                        <span class="inline-block w-2 h-2 rounded-full bg-red-400" title="Inactivo"></span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="planes.php?edit=<?php echo $plan['id']; ?>" class="text-blue-600 hover:bg-blue-50 px-2 py-1 rounded transition">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="planes.php" class="inline-block" onsubmit="return confirm('¿Eliminar plan?');">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                                        <button type="submit" class="text-red-400 hover:text-red-600 px-2 py-1 hover:bg-red-50 rounded transition">
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