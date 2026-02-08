<?php
// servicios.php - Conectado a Base de Datos
require 'admin/config/db.php'; // Conexión a BD

$pageTitle = "Soluciones y Precios";
include 'components/header.php';

// 1. Estructura Base de Categorías (Títulos y Descripciones se mantienen estáticos)
$categorias_planes = [
    'web' => [
        'titulo_seccion' => 'Desarrollo & Presencia Web',
        'descripcion_seccion' => 'Para negocios que necesitan visibilidad, posicionamiento y una imagen profesional impecable.',
        'planes' => [] 
    ],
    'sistemas' => [
        'titulo_seccion' => 'Sistemas Administrativos (SaaS)',
        'descripcion_seccion' => 'Software a medida para gestionar tu empresa. Deja el Excel y pásate a la nube.',
        'planes' => []
    ],
    'automatizacion' => [
        'titulo_seccion' => 'Automatización de Procesos',
        'descripcion_seccion' => 'Conectamos tus aplicaciones para que trabajen solas. Ahorra tiempo y elimina errores humanos.',
        'planes' => []
    ]
];

// 2. Obtener Planes Activos desde MySQL
try {
    $stmt = $pdo->query("SELECT * FROM plans WHERE activo = 1 ORDER BY precio ASC");
    $planes_db = $stmt->fetchAll();

    // 3. Organizar los planes en sus categorías
    foreach ($planes_db as $plan) {
        $cat = $plan['categoria'];
        
        // Decodificar las features de JSON a Array PHP para poder usarlas en el HTML
        $plan['features'] = json_decode($plan['features'], true);
        
        // Si la categoría existe en nuestro array base, agregamos el plan
        if (isset($categorias_planes[$cat])) {
            $categorias_planes[$cat]['planes'][] = $plan;
        }
    }
} catch (PDOException $e) {
    // En caso de error, array vacío para no romper la página
    error_log("Error DB: " . $e->getMessage());
}

// Datos visuales para ejemplos de automatización (Se mantienen estáticos por ahora)
$ejemplos_auto = [
    [
        'titulo' => 'Ventas Automáticas',
        'icono' => 'fa-robot',
        'texto' => 'El cliente pregunta precio en Instagram > El bot responde y envía catálogo > Cliente compra > Se registra la venta en Excel y se avisa al almacén.'
    ],
    [
        'titulo' => 'Gestión de Citas',
        'icono' => 'fa-calendar-check',
        'texto' => 'Cliente agenda en la web > Se bloquea el espacio en Google Calendar > Se envía confirmación por WhatsApp y recordatorio 1 hora antes.'
    ]
];
?>

<section class="relative pt-32 pb-24 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0h-2.828zM43.314 0L47.97 4.657l-1.414 1.414L40.486 0h2.828zM16.686 0L12.03 4.657 13.443 6.07 19.1 6.07 25.172 0h-2.83zM32 0l.83.828-1.415 1.415L30 0h2zM28 0l-.83.828L28.585 2.243 30 0h-2z\' fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');"></div>
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-600/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
        <div data-aos="fade-right">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900/30 border border-blue-500/30 text-blue-300 text-xs font-mono mb-6">
                <i class="fas fa-terminal text-[10px]"></i> system_status: active
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Arquitectura de <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Soluciones.</span>
            </h1>
            <p class="text-lg text-slate-400 mb-8 max-w-lg leading-relaxed">
                Elige el stack tecnológico que tu empresa necesita. Desde presencia web básica hasta ecosistemas de automatización complejos.
            </p>
        </div>
        <div data-aos="fade-left" class="hidden lg:block relative">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl blur opacity-20"></div>
            <div class="bg-[#0f172a] rounded-xl border border-slate-700 p-6 font-mono text-sm shadow-2xl relative">
                <div class="flex gap-2 mb-4">
                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                </div>
                <div class="text-slate-300">
                    <span class="text-purple-400">const</span> <span class="text-blue-400">selectedPlan</span> = {<br>
                    &nbsp;&nbsp;<span class="text-sky-300">type</span>: <span class="text-green-300">"SaaS & Automation"</span>,<br>
                    &nbsp;&nbsp;<span class="text-sky-300">scalability</span>: <span class="text-orange-400">true</span>,<br>
                    &nbsp;&nbsp;<span class="text-sky-300">support</span>: <span class="text-green-300">"24/7 Priority"</span>,<br>
                    &nbsp;&nbsp;<span class="text-sky-300">modules</span>: [<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-green-300">"CRM_Integration"</span>,<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-green-300">"Auto_Invoicing"</span><br>
                    &nbsp;&nbsp;]<br>
                    };<br><br>
                    <span class="text-slate-500">// Ready to deploy...</span><br>
                    <span class="animate-pulse text-blue-400">█</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-screen-xl mx-auto px-4 overflow-x-auto no-scrollbar">
        <div class="flex space-x-8 md:justify-center py-4 min-w-max">
            <a href="#web" class="flex items-center gap-2 text-slate-500 hover:text-[#0040A8] font-medium transition-colors group">
                <i class="fas fa-globe text-slate-400 group-hover:text-[#0040A8]"></i> Web Development
            </a>
            <a href="#sistemas" class="flex items-center gap-2 text-slate-500 hover:text-[#0040A8] font-medium transition-colors group">
                <i class="fas fa-server text-slate-400 group-hover:text-[#0040A8]"></i> Sistemas (SaaS)
            </a>
            <a href="#automatizacion" class="flex items-center gap-2 text-slate-500 hover:text-[#0040A8] font-medium transition-colors group">
                <i class="fas fa-bolt text-slate-400 group-hover:text-[#0040A8]"></i> Automatización
            </a>
        </div>
    </div>
</div>

<?php 
// Recorremos las categorías
foreach ($categorias_planes as $key => $categoria): 
    $isDarker = ($key === 'sistemas'); 
    $sectionBg = $isDarker ? 'bg-slate-50' : 'bg-white';
    
    // Si la categoría no tiene planes, la saltamos (opcional)
    if(empty($categoria['planes'])) continue;
?>

<section id="<?php echo $key; ?>" class="py-24 <?php echo $sectionBg; ?> relative">
    
    <?php if($key === 'web'): ?>
        <i class="fab fa-html5 absolute top-20 right-10 text-9xl text-orange-500 opacity-5 -rotate-12"></i>
    <?php elseif($key === 'sistemas'): ?>
        <i class="fas fa-database absolute bottom-20 left-10 text-9xl text-blue-500 opacity-5 rotate-12"></i>
    <?php elseif($key === 'automatizacion'): ?>
        <i class="fas fa-network-wired absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[20rem] text-[#0040A8] opacity-[0.03]"></i>
    <?php endif; ?>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6 border-b border-slate-200 pb-8" data-aos="fade-up">
            <div class="max-w-2xl">
                <span class="text-[#0040A8] font-mono text-xs uppercase tracking-widest mb-2 block">// Categoría: <?php echo $key; ?></span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3"><?php echo $categoria['titulo_seccion']; ?></h2>
                <p class="text-slate-500"><?php echo $categoria['descripcion_seccion']; ?></p>
            </div>
            <div class="hidden md:block">
                <?php if($key == 'web'): ?> <i class="fas fa-laptop-code text-4xl text-slate-300"></i>
                <?php elseif($key == 'sistemas'): ?> <i class="fas fa-cogs text-4xl text-slate-300"></i>
                <?php else: ?> <i class="fas fa-robot text-4xl text-slate-300"></i>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
            <?php foreach ($categoria['planes'] as $index => $plan): 
                $destacado = $plan['destacado'];
            ?>
            <div data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>" 
                 class="group relative bg-white rounded-2xl border transition-all duration-300 flex flex-col h-full
                 <?php echo $destacado ? 'border-[#0040A8] shadow-2xl scale-105 z-10' : 'border-slate-100 shadow-lg hover:shadow-xl hover:border-blue-200'; ?>">
                
                <?php if($destacado): ?>
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-[#0040A8] text-white px-4 py-1 rounded-full text-xs font-bold tracking-wide uppercase shadow-lg flex items-center gap-2">
                        <i class="fas fa-star text-[10px]"></i> Recomendado
                    </div>
                <?php endif; ?>

                <div class="p-8 flex-1">
                    <h3 class="text-xl font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($plan['titulo']); ?></h3>
                    
                    <div class="my-6 flex items-baseline">
                        <span class="text-4xl font-extrabold tracking-tight text-slate-900">$<?php echo htmlspecialchars($plan['precio']); ?></span>
                        <span class="ml-2 text-slate-400 text-sm font-medium">/mes</span>
                    </div>

                    <div class="h-px w-full bg-slate-100 mb-6 group-hover:bg-blue-50 transition-colors"></div>

                    <ul class="space-y-4">
                        <?php 
                        // Verificamos que 'features' sea un array válido antes de recorrerlo
                        if(is_array($plan['features'])):
                            foreach($plan['features'] as $feature): 
                        ?>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 w-5 h-5 rounded-full bg-blue-50 text-[#0040A8] flex items-center justify-center mt-0.5 group-hover:bg-[#0040A8] group-hover:text-white transition-colors">
                                <i class="fas fa-check text-[10px]"></i>
                            </div>
                            <span class="ml-3 text-slate-600 text-sm group-hover:text-slate-800 transition-colors"><?php echo htmlspecialchars($feature); ?></span>
                        </li>
                        <?php 
                            endforeach; 
                        endif;
                        ?>
                    </ul>
                </div>

                <div class="p-8 pt-0 mt-auto">
                    <a href="https://wa.me/584127703302?text=Hola,%20quiero%20empezar%20con%20el%20plan%20<?php echo urlencode($plan['titulo']); ?>" 
                       target="_blank"
                       class="w-full inline-flex justify-center items-center py-3.5 rounded-xl font-bold transition-all border
                       <?php echo $destacado ? 
                           'bg-[#0040A8] text-white hover:bg-[#003080] border-transparent shadow-lg shadow-blue-900/20' : 
                           'bg-white text-slate-700 border-slate-200 hover:border-[#0040A8] hover:text-[#0040A8]'; ?>">
                        Seleccionar Plan
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
    </div>
</section>
<?php endforeach; ?>

<section class="py-24 bg-[#0a0e17] text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#0040A8 1px, transparent 1px); background-size: 30px 30px;"></div>
    
    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Workflow Intelligence</h2>
            <p class="text-slate-400 max-w-2xl mx-auto">
                No vendemos solo software. Diseñamos la lógica que permite a tu negocio operar sin ti.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach($ejemplos_auto as $index => $ejemplo): ?>
            <div class="group bg-white/5 backdrop-blur-sm border border-white/10 p-8 rounded-2xl hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-600 to-cyan-500 flex items-center justify-center text-2xl shadow-lg shrink-0 group-hover:scale-110 transition-transform">
                        <i class="fas <?php echo $ejemplo['icono']; ?>"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3 text-white"><?php echo $ejemplo['titulo']; ?></h3>
                        <div class="text-sm font-mono text-blue-200 bg-black/30 p-4 rounded-lg border border-white/5 leading-relaxed">
                            <span class="text-green-400">INPUT:</span> <?php echo explode('>', $ejemplo['texto'])[0]; ?><br>
                            <span class="text-yellow-400">PROCESS:</span> ... Ejecutando lógica ...<br>
                            <span class="text-cyan-400">OUTPUT:</span> <?php echo substr($ejemplo['texto'], strpos($ejemplo['texto'], '>') + 1); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-16 text-center">
            <a href="contacto.php" class="inline-flex items-center gap-3 text-slate-300 hover:text-white transition-colors border-b border-blue-500/50 pb-1 hover:border-blue-400">
                <i class="fas fa-flask text-blue-500"></i>
                Solicitar análisis de procesos gratuito
            </a>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>