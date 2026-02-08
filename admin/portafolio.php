<?php
// admin/portafolio.php
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require 'config/db.php';

$mensaje = '';
$uploadDir = '../assets/img/portfolio/'; // Ruta relativa desde admin/

// Crear carpeta si no existe
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// --- LÓGICA POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        
        // 1. ELIMINAR
        if ($_POST['action'] === 'delete') {
            // Opcional: Borrar archivo físico si se desea
            $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
            $stmt->execute([$_POST['id']]);
            $mensaje = 'Proyecto eliminado.';
        }
        
        // 2. GUARDAR
        elseif ($_POST['action'] === 'save') {
            $titulo = $_POST['titulo'];
            $categoria = $_POST['categoria'];
            $cliente = $_POST['cliente'];
            $descripcion = $_POST['descripcion'];
            $stackJson = json_encode(explode(",", $_POST['stack'])); // Guardamos "PHP,JS" como array JSON
            
            // Manejo de Imagen
            $imgUrl = $_POST['current_img'] ?? ''; // Mantener la anterior por defecto
            
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $fileName = time() . '_' . basename($_FILES['imagen']['name']);
                $targetPath = $uploadDir . $fileName;
                $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
                
                // Validar imagen
                if(in_array($fileType, ['jpg', 'jpeg', 'png', 'webp'])) {
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $targetPath)) {
                        // Guardamos la ruta pública para la web
                        $imgUrl = 'assets/img/portfolio/' . $fileName;
                    }
                }
            }

            if (!empty($_POST['id'])) {
                // Update
                $sql = "UPDATE projects SET titulo=?, categoria=?, cliente=?, descripcion=?, stack=?, img_url=? WHERE id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $categoria, $cliente, $descripcion, $stackJson, $imgUrl, $_POST['id']]);
                $mensaje = 'Proyecto actualizado.';
            } else {
                // Insert
                $sql = "INSERT INTO projects (titulo, categoria, cliente, descripcion, stack, img_url) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $categoria, $cliente, $descripcion, $stackJson, $imgUrl]);
                $mensaje = 'Proyecto añadido al portafolio.';
            }
        }
    }
}

// Obtener datos para editar
$editProj = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$_GET['edit']]);
    $editProj = $stmt->fetch();
}

// Obtener todos
$proyectos = $pdo->query("SELECT * FROM projects ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portafolio | Viiu Panel</title>
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
                <h1 class="text-3xl font-bold text-slate-800">Portafolio</h1>
                <p class="text-slate-500 text-sm">Muestra tus casos de éxito al mundo.</p>
            </div>
            <?php if($editProj): ?>
                <a href="portafolio.php" class="bg-slate-200 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-300 transition">Cancelar</a>
            <?php endif; ?>
        </header>

        <?php if($mensaje): ?>
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 sticky top-4">
                    <h3 class="font-bold text-lg mb-4 text-slate-700 border-b pb-2">
                        <?php echo $editProj ? 'Editar Proyecto' : 'Nuevo Proyecto'; ?>
                    </h3>
                    <form method="POST" action="portafolio.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="id" value="<?php echo $editProj['id'] ?? ''; ?>">
                        <input type="hidden" name="current_img" value="<?php echo $editProj['img_url'] ?? ''; ?>">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Título del Proyecto</label>
                                <input type="text" name="titulo" required value="<?php echo $editProj['titulo'] ?? ''; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Cliente</label>
                                    <input type="text" name="cliente" required value="<?php echo $editProj['cliente'] ?? ''; ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Categoría</label>
                                    <select name="categoria" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                        <?php $cat = $editProj['categoria'] ?? ''; ?>
                                        <option value="web" <?php echo $cat == 'web' ? 'selected' : ''; ?>>Web Dev</option>
                                        <option value="sistemas" <?php echo $cat == 'sistemas' ? 'selected' : ''; ?>>Sistemas</option>
                                        <option value="automatizacion" <?php echo $cat == 'automatizacion' ? 'selected' : ''; ?>>Automatización</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Descripción Breve</label>
                                <textarea name="descripcion" rows="3" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"><?php echo $editProj['descripcion'] ?? ''; ?></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Tecnologías (Separadas por coma)</label>
                                <input type="text" name="stack" placeholder="React, Node.js, MySQL" value="<?php 
                                    if(isset($editProj['stack'])) {
                                        $stackArr = json_decode($editProj['stack'], true);
                                        echo is_array($stackArr) ? implode(',', $stackArr) : ''; 
                                    }
                                ?>" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Imagen Destacada</label>
                                <?php if(isset($editProj['img_url']) && $editProj['img_url']): ?>
                                    <img src="../<?php echo $editProj['img_url']; ?>" class="w-full h-32 object-cover rounded-lg mb-2 border">
                                <?php endif; ?>
                                <input type="file" name="imagen" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-slate-400 mt-1">Formatos: JPG, PNG, WEBP</p>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-blue-900/20">
                                Guardar Proyecto
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="xl:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 auto-rows-max">
                <?php foreach($proyectos as $proj): ?>
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <?php if($proj['img_url']): ?>
                            <img src="../<?php echo $proj['img_url']; ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <?php else: ?>
                            <div class="flex items-center justify-center h-full text-slate-300"><i class="fas fa-image text-3xl"></i></div>
                        <?php endif; ?>
                        
                        <div class="absolute top-2 right-2 flex gap-2">
                            <a href="portafolio.php?edit=<?php echo $proj['id']; ?>" class="w-8 h-8 rounded-full bg-white text-blue-600 flex items-center justify-center shadow hover:bg-blue-600 hover:text-white transition">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <form method="POST" action="portafolio.php" onsubmit="return confirm('Eliminar proyecto?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $proj['id']; ?>">
                                <button class="w-8 h-8 rounded-full bg-white text-red-500 flex items-center justify-center shadow hover:bg-red-500 hover:text-white transition">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-bold text-lg text-slate-800 leading-tight"><?php echo htmlspecialchars($proj['titulo']); ?></h4>
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-1 rounded"><?php echo $proj['categoria']; ?></span>
                        </div>
                        <p class="text-sm text-slate-500 mb-4"><?php echo htmlspecialchars($proj['cliente']); ?></p>
                        <div class="flex flex-wrap gap-1">
                            <?php 
                                $stack = json_decode($proj['stack'], true);
                                if(is_array($stack)) {
                                    foreach($stack as $tech) {
                                        echo '<span class="text-[10px] bg-blue-50 text-blue-700 px-2 py-0.5 rounded border border-blue-100">' . htmlspecialchars(trim($tech)) . '</span>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
</html>