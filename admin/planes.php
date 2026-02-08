<?php
// admin/planes.php - VERSIÓN CORREGIDA (SOLUCIÓN DE WARNINGS)
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require 'config/db.php';

$mensaje = '';

// --- LÓGICA POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // 1. ELIMINAR PLAN
        if ($_POST['action'] === 'delete') {
            $stmt = $pdo->prepare("DELETE FROM plans WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $mensaje = 'Plan eliminado correctamente.';
        }
        // 2. GUARDAR (Crear o Editar)
        elseif ($_POST['action'] === 'save') {
            $titulo = $_POST['titulo'] ?? 'Nuevo Plan';
            $precio = $_POST['precio'] ?? 0.00;
            
            // CORRECCIÓN AQUÍ: Usamos '??' para evitar el error "Undefined array key"
            // Esto asigna 0 automáticamente si el campo no viene en el formulario
            $setup_fee = $_POST['setup_fee'] ?? 0.00;
            $descuento_anual = $_POST['descuento_anual'] ?? 0;
            
            $categoria = $_POST['categoria'] ?? 'web';
            
            // Procesamiento de Features (JSON)
            $rawFeatures = $_POST['features'] ?? '';
            $featuresArray = array_filter(explode("\n", str_replace("\r", "", $rawFeatures)));
            $featuresJson = json_encode(array_values($featuresArray), JSON_UNESCAPED_UNICODE);
            
            $destacado = isset($_POST['destacado']) ? 1 : 0;
            $activo = isset($_POST['activo']) ? 1 : 0;

            try {
                if (!empty($_POST['id'])) {
                    // UPDATE
                    $sql = "UPDATE plans SET titulo=?, precio=?, setup_fee=?, descuento_anual=?, categoria=?, features=?, destacado=?, activo=? WHERE id=?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$titulo, $precio, $setup_fee, $descuento_anual, $categoria, $featuresJson, $destacado, $activo, $_POST['id']]);
                    $mensaje = 'Plan actualizado con éxito.';
                } else {
                    // INSERT
                    $sql = "INSERT INTO plans (titulo, precio, setup_fee, descuento_anual, categoria, features, destacado, activo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$titulo, $precio, $setup_fee, $descuento_anual, $categoria, $featuresJson, $destacado, $activo]);
                    $mensaje = 'Nuevo plan creado exitosamente.';
                }
            } catch (PDOException $e) {
                $mensaje = "Error en base de datos: " . $e->getMessage();
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
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen">
    
    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 p-8 overflow-y-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Estrategia Comercial</h1>
                <p class="text-slate-500 text-sm">Define precios mensuales, cuotas de inicio y ofertas.</p>
            </div>
            <?php if($editPlan): ?>
                <a href="planes.php" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition font-medium">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            <?php endif; ?>
        </header>

        <?php if($mensaje): ?>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 px-4 py-3 rounded shadow-sm mb-6 flex items-center">
                <i class="fas fa-info-circle mr-2"></i> <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <div class="xl:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 sticky top-4">
                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <h3 class="font-bold text-lg text-slate-800">
                            <?php echo $editPlan ? 'Editar Estrategia' : 'Nuevo Plan'; ?>
                        </h3>
                        <div class="bg-blue-50 text-blue-600 rounded-full p-2">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>

                    <form method="POST" action="planes.php">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="id" value="<?php echo $editPlan['id'] ?? ''; ?>">

                        <div class="space-y-5">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Nombre del Servicio</label>
                                <input type="text" name="titulo" required value="<?php echo $editPlan['titulo'] ?? ''; ?>" 
                                       class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-3 rounded-lg border border-slate-200">
                                <div>
                                    <label class="block text-xs font-bold text-blue-600 mb-1">Mensualidad ($)</label>
                                    <input type="number" step="0.01" name="precio" required value="<?php echo $editPlan['precio'] ?? ''; ?>" 
                                           class="w-full p-2 border border-blue-200 rounded focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-700">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-green-600 mb-1">Setup Fee ($)</label>
                                    <input type="number" step="0.01" name="setup_fee" value="<?php echo $editPlan['setup_fee'] ?? '0.00'; ?>" 
                                           class="w-full p-2 border border-green-200 rounded focus:ring-2 focus:ring-green-500 outline-none font-bold text-slate-700">
                                    <p class="text-[10px] text-slate-400 mt-1">Pago único inicial</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Categoría</label>
                                    <select name="categoria" class="w-full p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                                        <?php $cat = $editPlan['categoria'] ?? ''; ?>
                                        <option value="web" <?php echo $cat == 'web' ? 'selected' : ''; ?>>Web Dev</option>
                                        <option value="sistemas" <?php echo $cat == 'sistemas' ? 'selected' : ''; ?>>Sistemas SaaS</option>
                                        <option value="automatizacion" <?php echo $cat == 'automatizacion' ? 'selected' : ''; ?>>Automatización</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">% Desc. Anual</label>
                                    <input type="number" name="descuento_anual" value="<?php echo $editPlan['descuento_anual'] ?? '0'; ?>" 
                                           class="w-full p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">
                                    Características (Una por línea)
                                </label>
                                <textarea name="features" rows="6" 
                                          class="w-full p-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm font-mono text-slate-600 leading-relaxed"><?php 
                                    if ($editPlan && $editPlan['features']) {
                                        $feats = json_decode($editPlan['features'], true);
                                        if(is_array($feats)) echo implode("\n", $feats);
                                    }
                                ?></textarea>
                            </div>

                            <div class="flex items-center justify-between pt-2 bg-gray-50 p-3 rounded-lg">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="destacado" class="sr-only peer" <?php echo ($editPlan['destacado'] ?? 0) ? 'checked' : ''; ?>>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-400"></div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Destacado</span>
                                </label>

                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="activo" class="sr-only peer" <?php echo ($editPlan['activo'] ?? 1) ? 'checked' : ''; ?>>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                    <span class="ml-2 text-sm font-medium text-slate-700">Activo</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-all shadow-lg shadow-blue-500/30 flex justify-center items-center gap-2">
                                <i class="fas fa-save"></i> <?php echo $editPlan ? 'Guardar Cambios' : 'Publicar Plan'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="xl:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-4 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="font-bold text-slate-700">Planes Activos</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full"><?php echo count($planes); ?> Total</span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-600">
                            <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Plan & Categoría</th>
                                    <th class="px-6 py-4">Precios</th>
                                    <th class="px-6 py-4 text-center">Estado</th>
                                    <th class="px-6 py-4 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <?php foreach($planes as $plan): 
                                    // Aseguramos que no haya errores visuales si falta algún dato
                                    $p_precio = $plan['precio'] ?? 0;
                                    $p_setup = $plan['setup_fee'] ?? 0;
                                    $p_desc = $plan['descuento_anual'] ?? 0;
                                ?>
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800 text-base"><?php echo htmlspecialchars($plan['titulo']); ?></div>
                                        <span class="inline-block mt-1 text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-500 border border-slate-200">
                                            <?php echo $plan['categoria']; ?>
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col space-y-1">
                                            <div class="flex items-center text-blue-700 font-bold">
                                                <span class="w-16 text-xs text-slate-400 font-normal">Mensual:</span>
                                                $<?php echo number_format($p_precio, 2); ?>
                                            </div>
                                            
                                            <?php if($p_setup > 0): ?>
                                                <div class="flex items-center text-green-700 font-medium text-xs">
                                                    <span class="w-16 text-slate-400 font-normal">Inicio:</span>
                                                    + $<?php echo number_format($p_setup, 2); ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if($p_desc > 0): ?>
                                                <div class="flex items-center text-orange-600 text-[10px] font-bold mt-1">
                                                    <i class="fas fa-tag mr-1"></i> -<?php echo $p_desc; ?>% Anual
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <?php if($plan['activo']): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Activo
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span> Off
                                                </span>
                                            <?php endif; ?>
                                            
                                            <?php if($plan['destacado']): ?>
                                                <span class="text-yellow-500 text-xs font-bold">
                                                    <i class="fas fa-star"></i> Top
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2 opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition-opacity">
                                            <a href="planes.php?edit=<?php echo $plan['id']; ?>" class="bg-white border border-slate-200 text-blue-600 hover:bg-blue-50 p-2 rounded-lg">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form method="POST" action="planes.php" onsubmit="return confirm('¿Eliminar?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $plan['id']; ?>">
                                                <button type="submit" class="bg-white border border-slate-200 text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>