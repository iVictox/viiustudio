<?php
// servicios.php - Viiu Studio (Versión Corregida)
// Usamos require_once para evitar errores de doble carga en la BD
require_once 'admin/config/db.php'; 

// Configuración de la página
$pageTitle = "Planes y Precios | Viiu Studio";

// Usamos include_once para evitar el error "Cannot redeclare nav_classes()"
include_once 'components/header.php';
include_once 'components/navbar.php'; 

// Definir estructura de categorías para ordenamiento visual
$categorias_planes = [
    'web' => [
        'titulo' => 'Desarrollo Web & Presencia',
        'desc' => 'Sitios web de alto impacto diseñados para convertir visitas en clientes.',
        'icono' => 'fa-laptop-code',
        'planes' => [] 
    ],
    'sistemas' => [
        'titulo' => 'Sistemas Administrativos (SaaS)',
        'desc' => 'Software en la nube para gestionar tu empresa. Paga por uso, sin inversiones millonarias.',
        'icono' => 'fa-server',
        'planes' => []
    ],
    'automatizacion' => [
        'titulo' => 'Automatización & IA',
        'desc' => 'Bots y flujos de trabajo inteligentes que operan 24/7.',
        'icono' => 'fa-robot',
        'planes' => []
    ]
];

// Obtener planes activos de la BD
try {
    // Solo traemos los que tienen activo = 1
    $stmt = $pdo->query("SELECT * FROM plans WHERE activo = 1 ORDER BY precio ASC");
    $planes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organizar los planes en sus categorías
    foreach ($planes_db as $plan) {
        // Validación de seguridad por si faltan campos
        $cat = $plan['categoria'] ?? 'web';
        $plan['features'] = json_decode($plan['features'] ?? '[]', true);
        
        if (isset($categorias_planes[$cat])) {
            $categorias_planes[$cat]['planes'][] = $plan;
        }
    }
} catch (PDOException $e) {
    error_log("Error DB: " . $e->getMessage());
}
?>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-700 text-blue-300 text-xs font-bold uppercase tracking-widest mb-4">
            Precios Transparentes
        </span>
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
            Invierte en tecnología,<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">no en problemas.</span>
        </h1>
        <p class="text-lg text-slate-400 mb-8 max-w-2xl mx-auto leading-relaxed">
            Sin letras pequeñas. Elige el plan que se adapte a tu etapa de crecimiento. 
            Escala cuando lo necesites.
        </p>
        
        <div class="flex flex-wrap justify-center gap-3">
            <a href="#web" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-blue-500 hover:text-blue-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-laptop-code"></i> Web
            </a>
            <a href="#sistemas" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-emerald-500 hover:text-emerald-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-server"></i> Sistemas
            </a>
            <a href="#automatizacion" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-purple-500 hover:text-purple-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-robot"></i> Bots
            </a>
        </div>
    </div>
</section>

<?php 
foreach ($categorias_planes as $key => $categoria): 
    // Si la categoría no tiene planes, la saltamos
    if(empty($categoria['planes'])) continue;
    
    // Alternar colores de fondo para separar secciones visualmente
    $bgClass = ($key === 'sistemas') ? 'bg-slate-50' : 'bg-white';
?>

<section id="<?php echo $key; ?>" class="py-24 <?php echo $bgClass; ?> relative scroll-mt-20">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 text-blue-600 mb-4 text-xl">
                <i class="fas <?php echo $categoria['icono']; ?>"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3"><?php echo $categoria['titulo']; ?></h2>
            <p class="text-slate-500 text-lg"><?php echo $categoria['desc']; ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            <?php foreach ($categoria['planes'] as $plan): 
                $esDestacado = $plan['destacado'] ?? 0;
                $setupFee = floatval($plan['setup_fee'] ?? 0);
                $descuento = intval($plan['descuento_anual'] ?? 0);
                $precio = floatval($plan['precio'] ?? 0);
                $precio_entero = floor($precio);
                $precio_decimal = sprintf("%02d", ($precio - $precio_entero) * 100);
            ?>
            
            <div class="group relative bg-white rounded-2xl transition-all duration-300 flex flex-col h-full overflow-hidden border
                <?php echo $esDestacado 
                    ? 'border-blue-600 shadow-2xl scale-105 z-10 ring-4 ring-blue-600/10' 
                    : 'border-slate-200 shadow-lg hover:shadow-xl hover:border-blue-300'; ?>">
                
                <?php if($esDestacado): ?>
                    <div class="bg-blue-600 text-white text-center py-1.5 text-xs font-bold uppercase tracking-wider">
                        <i class="fas fa-star mr-1"></i> Recomendado
                    </div>
                <?php endif; ?>

                <div class="p-8 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($plan['titulo']); ?></h3>
                    
                    <div class="flex items-baseline my-4 text-slate-900">
                        <span class="text-5xl font-extrabold tracking-tight">$<?php echo $precio_entero; ?></span>
                        <div class="flex flex-col ml-1">
                            <span class="text-lg font-bold leading-none">.<?php echo $precio_decimal; ?></span>
                            <span class="text-slate-500 text-xs font-medium uppercase mt-1">/mes</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-lg p-4 mb-6 border border-slate-100 space-y-2">
                        <?php if($setupFee > 0): ?>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Instalación (Único pago):</span>
                                <span class="font-bold text-slate-800">$<?php echo number_format($setupFee, 2); ?></span>
                            </div>
                        <?php else: ?>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Instalación:</span>
                                <span class="font-bold text-green-600 uppercase text-xs">Gratis</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($descuento > 0): ?>
                            <div class="pt-2 mt-2 border-t border-slate-200 flex items-center text-emerald-600 text-xs font-bold">
                                <i class="fas fa-tag mr-2"></i>
                                <span>Paga anual y ahorra <?php echo $descuento; ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <ul class="space-y-4 mb-8 flex-1">
                        <?php if(is_array($plan['features'])): foreach($plan['features'] as $feature): ?>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-3 text-sm flex-shrink-0"></i>
                            <span class="text-slate-600 text-sm font-medium leading-tight"><?php echo htmlspecialchars($feature); ?></span>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>

                    <?php 
                        $mensaje = "Hola Viiu Studio 👋, estoy interesado en el plan *{$plan['titulo']}* ($ {$precio}/mes). ¿Podrían darme más información?";
                        $linkWa = "https://wa.me/584127703302?text=" . urlencode($mensaje);
                    ?>
                    <a href="<?php echo $linkWa; ?>" target="_blank" 
                       class="w-full inline-flex justify-center items-center py-3.5 rounded-xl font-bold transition-all duration-200
                       <?php echo $esDestacado 
                           ? 'bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-600/30 hover:-translate-y-1' 
                           : 'bg-white text-slate-700 border-2 border-slate-200 hover:border-blue-600 hover:text-blue-600'; ?>">
                        Contratar Ahora <i class="fab fa-whatsapp ml-2 text-lg"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-blue-600/10"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl font-bold mb-6">¿Necesitas una solución a medida?</h2>
        <p class="text-slate-300 text-lg mb-8">
            Entendemos que cada negocio es único. Si necesitas un desarrollo específico fuera de estos planes, 
            podemos armar una propuesta personalizada para ti.
        </p>
        <a href="contacto.php" class="inline-block bg-white text-slate-900 hover:bg-blue-50 font-bold py-3 px-8 rounded-full transition-colors shadow-lg">
            Hablar con un Consultor
        </a>
    </div>
</section>

<?php include 'components/footer.php'; ?>