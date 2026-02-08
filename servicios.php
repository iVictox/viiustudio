<?php
// servicios.php - Optimizado para Conversión y Transparencia
require 'admin/config/db.php'; 

$pageTitle = "Soluciones y Precios";
include 'components/header.php';

// Estructura Base de Categorías
$categorias_planes = [
    'web' => [
        'titulo_seccion' => 'Desarrollo & Presencia Web',
        'descripcion_seccion' => 'Sitios de alto impacto diseñados para convertir visitas en clientes.',
        'planes' => [] 
    ],
    'sistemas' => [
        'titulo_seccion' => 'Sistemas SaaS & ERP',
        'descripcion_seccion' => 'Software a medida para tu empresa. Paga por uso, no por desarrollo millonario.',
        'planes' => []
    ],
    'automatizacion' => [
        'titulo_seccion' => 'Automatización con IA',
        'descripcion_seccion' => 'Bots y flujos de trabajo que operan 24/7 sin descanso.',
        'planes' => []
    ]
];

// Obtener Planes
try {
    $stmt = $pdo->query("SELECT * FROM plans WHERE activo = 1 ORDER BY precio ASC");
    $planes_db = $stmt->fetchAll();
    foreach ($planes_db as $plan) {
        $cat = $plan['categoria'];
        $plan['features'] = json_decode($plan['features'], true);
        if (isset($categorias_planes[$cat])) {
            $categorias_planes[$cat]['planes'][] = $plan;
        }
    }
} catch (PDOException $e) { error_log("Error DB: " . $e->getMessage()); }
?>

<section class="relative pt-32 pb-24 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
            Precios Transparentes,<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Resultados Reales.</span>
        </h1>
        <p class="text-lg text-slate-400 mb-8 max-w-2xl mx-auto leading-relaxed">
            Sin contratos forzosos a largo plazo. Invertimos en tu tecnología inicial (Setup) y mantenemos tu operación mes a mes.
        </p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#web" class="px-5 py-2 rounded-full bg-slate-800 border border-slate-700 hover:border-blue-500 transition-colors text-sm font-bold">Web</a>
            <a href="#sistemas" class="px-5 py-2 rounded-full bg-slate-800 border border-slate-700 hover:border-blue-500 transition-colors text-sm font-bold">Sistemas</a>
            <a href="#automatizacion" class="px-5 py-2 rounded-full bg-slate-800 border border-slate-700 hover:border-blue-500 transition-colors text-sm font-bold">Automatización</a>
        </div>
    </div>
</section>

<?php 
foreach ($categorias_planes as $key => $categoria): 
    if(empty($categoria['planes'])) continue;
    $isDarker = ($key === 'sistemas'); 
    $sectionBg = $isDarker ? 'bg-slate-50' : 'bg-white';
?>

<section id="<?php echo $key; ?>" class="py-24 <?php echo $sectionBg; ?> relative scroll-mt-20">
    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#0040A8] font-bold text-xs uppercase tracking-widest mb-2 block"><?php echo $categoria['titulo_seccion']; ?></span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">Elige tu nivel de escalabilidad</h2>
            <p class="text-slate-500 text-lg"><?php echo $categoria['descripcion_seccion']; ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            <?php foreach ($categoria['planes'] as $index => $plan): 
                $destacado = $plan['destacado'];
                $setup_fee = $plan['setup_fee'];
            ?>
            <div data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>" 
                 class="group relative bg-white rounded-2xl border transition-all duration-300 flex flex-col h-full overflow-hidden
                 <?php echo $destacado ? 'border-[#0040A8] shadow-2xl scale-105 z-10 ring-4 ring-blue-500/10' : 'border-slate-200 shadow-lg hover:shadow-xl hover:border-blue-300'; ?>">
                
                <?php if($destacado): ?>
                    <div class="bg-[#0040A8] text-white text-center py-2 text-xs font-bold uppercase tracking-wider">
                        <i class="fas fa-star mr-1"></i> Más Popular
                    </div>
                <?php endif; ?>

                <div class="p-8 flex-1">
                    <h3 class="text-xl font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($plan['titulo']); ?></h3>
                    
                    <div class="flex items-baseline my-4">
                        <span class="text-5xl font-extrabold tracking-tight text-slate-900">$<?php echo intval($plan['precio']); ?></span>
                        <div class="flex flex-col ml-2">
                            <span class="text-slate-900 font-bold text-lg">.<?php echo explode('.', $plan['precio'])[1] ?? '00'; ?></span>
                            <span class="text-slate-500 text-xs font-medium">/mes</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-lg p-3 mb-6 border border-slate-100">
                        <?php if($setup_fee > 0): ?>
                            <div class="flex justify-between items-center text-sm mb-1">
                                <span class="text-slate-600 font-medium">Instalación Única:</span>
                                <span class="font-bold text-slate-800">$<?php echo $setup_fee; ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if($plan['descuento_anual'] > 0): ?>
                            <div class="flex justify-between items-center text-xs mt-2 pt-2 border-t border-slate-200 text-green-600">
                                <span class="font-bold"><i class="fas fa-tag mr-1"></i> Plan Anual</span>
                                <span class="font-bold bg-green-100 px-2 py-0.5 rounded">Ahorra <?php echo $plan['descuento_anual']; ?>%</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <?php if(is_array($plan['features'])): foreach($plan['features'] as $feature): ?>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-[#0040A8] mt-1 mr-3 text-sm"></i>
                            <span class="text-slate-600 text-sm font-medium"><?php echo htmlspecialchars($feature); ?></span>
                        </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>

                <div class="p-8 pt-0 mt-auto">
                    <?php 
                        // Mensaje personalizado para WhatsApp
                        $msg = "Hola Viiu Studio, estoy interesado en el plan *{$plan['titulo']}* ($ {$plan['precio']}/mes + Setup). ¿Podemos agendar?";
                    ?>
                    <a href="https://wa.me/584127703302?text=<?php echo urlencode($msg); ?>" 
                       target="_blank"
                       class="w-full inline-flex justify-center items-center py-4 rounded-xl font-bold transition-all
                       <?php echo $destacado ? 
                           'bg-[#0040A8] text-white hover:bg-[#003080] shadow-lg shadow-blue-900/30 hover:-translate-y-1' : 
                           'bg-slate-50 text-slate-700 hover:bg-slate-100 border border-slate-200 hover:border-slate-300'; ?>">
                        Comenzar Ahora <i class="fab fa-whatsapp ml-2"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<?php include 'components/footer.php'; ?>