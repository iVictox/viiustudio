<?php
// servicios.php - Viiu Studio (Versión Final con Animaciones AOS)
require_once 'admin/config/db.php'; 

$pageTitle = "Planes y Precios | Viiu Studio";
include_once 'components/header.php';
include_once 'components/navbar.php'; 

// Definir estructura de categorías
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
    $stmt = $pdo->query("SELECT * FROM plans WHERE activo = 1 ORDER BY precio ASC");
    $planes_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($planes_db as $plan) {
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
        <span data-aos="fade-down" data-aos-delay="100" class="inline-block py-1 px-3 rounded-full bg-blue-900/50 border border-blue-700 text-blue-300 text-xs font-bold uppercase tracking-widest mb-4">
            Precios Transparentes
        </span>
        
        <h1 data-aos="fade-up" data-aos-delay="200" class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
            Invierte en tecnología,<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">no en problemas.</span>
        </h1>
        
        <p data-aos="fade-up" data-aos-delay="300" class="text-lg text-slate-400 mb-8 max-w-2xl mx-auto leading-relaxed">
            Sin letras pequeñas. Elige el plan que se adapte a tu etapa de crecimiento. 
            Escala cuando lo necesites.
        </p>
        
        <div data-aos="fade-up" data-aos-delay="400" class="flex flex-wrap justify-center gap-3">
            <a href="#web" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-blue-500 hover:text-blue-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-laptop-code"></i> Web
            </a>
            <a href="#sistemas" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-emerald-500 hover:text-emerald-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-server"></i> Sistemas
            </a>
            <a href="#automatizacion" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-purple-500 hover:text-purple-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-robot"></i> Bots
            </a>
            <a href="#amedida" class="px-5 py-2.5 rounded-xl bg-slate-800 border border-slate-700 hover:border-orange-500 hover:text-orange-400 transition-all text-sm font-bold flex items-center gap-2">
                <i class="fas fa-ruler-combined"></i> A Medida
            </a>
        </div>
    </div>
</section>

<?php 
foreach ($categorias_planes as $key => $categoria): 
    if(empty($categoria['planes'])) continue;
    $bgClass = ($key === 'sistemas') ? 'bg-slate-50' : 'bg-white';
?>

<section id="<?php echo $key; ?>" class="py-24 <?php echo $bgClass; ?> relative scroll-mt-20">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 text-blue-600 mb-4 text-xl">
                <i class="fas <?php echo $categoria['icono']; ?>"></i>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3"><?php echo $categoria['titulo']; ?></h2>
            <p class="text-slate-500 text-lg"><?php echo $categoria['desc']; ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            <?php 
            $delay = 0; // Reiniciar delay para cada categoría
            foreach ($categoria['planes'] as $plan): 
                $esDestacado = $plan['destacado'] ?? 0;
                $setupFee = floatval($plan['setup_fee'] ?? 0);
                $descuento = intval($plan['descuento_anual'] ?? 0);
                $precio = floatval($plan['precio'] ?? 0);
                $precio_entero = floor($precio);
                $precio_decimal = sprintf("%02d", ($precio - $precio_entero) * 100);
                
                // Incremento de delay para efecto cascada (0, 100, 200...)
                $delay += 100;
            ?>
            
            <div data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" 
                 class="group relative bg-white rounded-2xl transition-all duration-300 flex flex-col h-full overflow-hidden border
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

                    <div class="bg-slate-50 rounded-lg p-4 mb-6 border border-slate-100 space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-slate-500 font-medium">Costo de Instalación:</span>
                            
                            <?php if($setupFee == 0): ?>
                                <span class="font-extrabold text-green-600 bg-green-50 px-2 py-0.5 rounded border border-green-100 text-xs uppercase">
                                    Gratis <span class="line-through text-green-800/40 normal-case ml-1">$50</span>
                                </span>
                            <?php elseif($setupFee > 0 && $setupFee < 30): ?>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-slate-400 line-through">$80</span>
                                    <span class="font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">$<?php echo number_format($setupFee, 0); ?></span>
                                </div>
                            <?php else: ?>
                                <span class="font-bold text-slate-800">$<?php echo number_format($setupFee, 2); ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if($descuento > 0): ?>
                            <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-xs">
                                <span class="text-slate-500">Plan Anual:</span>
                                <span class="text-emerald-600 font-bold bg-emerald-50 px-2 py-1 rounded">
                                    <i class="fas fa-arrow-down mr-1"></i>Ahorras <?php echo $descuento; ?>%
                                </span>
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
                        $mensaje = "Hola Viiu Studio 👋, estoy interesado en el plan *{$plan['titulo']}*. ¿Podrían darme más información?";
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

<section id="amedida" class="py-24 bg-slate-900 text-white relative scroll-mt-20 overflow-hidden">
    <div class="absolute inset-0 bg-blue-600/5"></div>
    
    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <div data-aos="fade-right">
                <span class="text-orange-400 font-bold text-xs uppercase tracking-widest mb-2 block">Enterprise & Startups</span>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">¿Necesitas una solución <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-red-500">A Medida?</span></h2>
                <p class="text-slate-400 text-lg mb-8 leading-relaxed">
                    Diseñamos arquitecturas complejas para requerimientos específicos. Si tu proyecto involucra Inteligencia Artificial avanzada, desarrollo SaaS de gran escala o integraciones múltiples, este es tu plan.
                </p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center text-orange-400 mr-4"><i class="fas fa-brain"></i></div>
                        <div>
                            <h4 class="font-bold">Inteligencia Artificial</h4>
                            <p class="text-sm text-slate-500">Modelos de lenguaje, visión por computador y análisis predictivo.</p>
                        </div>
                    </div>
                    <div class="flex items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center text-blue-400 mr-4"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <h4 class="font-bold">Plataformas SaaS</h4>
                            <p class="text-sm text-slate-500">Sistemas multi-tenant, facturación recurrente y paneles administrativos.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div data-aos="fade-left" class="bg-slate-800/50 backdrop-blur-sm border border-slate-700 rounded-2xl p-8 lg:p-10 shadow-2xl relative">
                <div class="absolute top-0 right-0 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg rounded-tr-lg">PERSONALIZADO</div>
                
                <h3 class="text-2xl font-bold mb-2">Plan Corporativo / Custom</h3>
                <p class="text-slate-400 text-sm mb-6">Definido según el alcance del proyecto.</p>

                <div class="flex items-baseline mb-8">
                    <span class="text-4xl font-extrabold text-white">A Consultar</span>
                </div>

                <div class="bg-slate-900/50 rounded-lg p-4 mb-8 border border-slate-700">
                    <div class="flex justify-between items-center text-sm mb-2">
                        <span class="text-slate-400">Costo de Instalación:</span>
                        <span class="font-bold text-white">Variable</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-slate-400">Mantenimiento:</span>
                        <span class="font-bold text-white">Bajo Demanda</span>
                    </div>
                </div>

                <ul class="space-y-3 mb-8">
                    <li class="flex items-start text-sm text-slate-300"><i class="fas fa-check text-orange-500 mt-1 mr-3"></i> Consultoría Técnica Especializada</li>
                    <li class="flex items-start text-sm text-slate-300"><i class="fas fa-check text-orange-500 mt-1 mr-3"></i> Arquitectura de Software Escalable</li>
                    <li class="flex items-start text-sm text-slate-300"><i class="fas fa-check text-orange-500 mt-1 mr-3"></i> Integración de APIs complejas</li>
                    <li class="flex items-start text-sm text-slate-300"><i class="fas fa-check text-orange-500 mt-1 mr-3"></i> Soporte Prioritario SLA</li>
                </ul>

                <?php 
                    $mensajeCustom = "Hola, necesito cotizar un proyecto a medida (Custom) para mi empresa.";
                    $linkWaCustom = "https://wa.me/584127703302?text=" . urlencode($mensajeCustom);
                ?>
                <a href="<?php echo $linkWaCustom; ?>" target="_blank" class="w-full block text-center bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-orange-900/20">
                    Solicitar Cotización <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php include_once 'components/footer.php'; ?>