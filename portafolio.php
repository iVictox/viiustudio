<?php
// portafolio.php - Conectado a Base de Datos
require 'admin/config/db.php'; // Conexión a BD

$pageTitle = "Nuestro Trabajo";
include 'components/header.php';

// Obtener Proyectos desde MySQL
try {
    $stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
    $proyectos = $stmt->fetchAll();
} catch (PDOException $e) {
    $proyectos = [];
    error_log("Error DB: " . $e->getMessage());
}
?>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0 opacity-[0.05] font-mono text-xs leading-4 overflow-hidden select-none pointer-events-none text-blue-500">
        <?php for($i=0; $i<4000; $i++) echo rand(0,1) . " "; ?>
    </div>
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-[#0040A8] opacity-20 blur-[120px]"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 text-center">
        <div data-aos="fade-down" class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900/50 border border-blue-500/30 text-blue-300 text-xs font-mono mb-6 backdrop-blur-md">
            <i class="fas fa-folder-open"></i> /var/www/portfolio
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6" data-aos="fade-up">
            Menos palabras, <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">más código.</span>
        </h1>
        
        <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Explora cómo hemos transformado problemas complejos en soluciones digitales elegantes. Desde algoritmos de automatización hasta interfaces web inmersivas.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50 min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="flex flex-wrap justify-center gap-4 mb-16" data-aos="fade-up">
            <button class="filter-btn active group relative px-6 py-2.5 rounded-lg text-sm font-bold transition-all bg-[#0040A8] text-white shadow-lg shadow-blue-900/20" data-filter="all">
                <i class="fas fa-layer-group mr-2"></i> Todos
            </button>
            <button class="filter-btn group relative px-6 py-2.5 rounded-lg text-sm font-bold transition-all bg-white text-slate-600 border border-slate-200 hover:border-[#0040A8] hover:text-[#0040A8]" data-filter="web">
                <i class="fas fa-globe mr-2"></i> Web Dev
            </button>
            <button class="filter-btn group relative px-6 py-2.5 rounded-lg text-sm font-bold transition-all bg-white text-slate-600 border border-slate-200 hover:border-[#0040A8] hover:text-[#0040A8]" data-filter="sistemas">
                <i class="fas fa-database mr-2"></i> Sistemas SaaS
            </button>
            <button class="filter-btn group relative px-6 py-2.5 rounded-lg text-sm font-bold transition-all bg-white text-slate-600 border border-slate-200 hover:border-[#0040A8] hover:text-[#0040A8]" data-filter="automatizacion">
                <i class="fas fa-robot mr-2"></i> Automatización
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($proyectos as $index => $proyecto): 
                // Decodificamos el JSON del stack tecnológico para usarlo en el loop
                $stackArray = json_decode($proyecto['stack'], true);
                if (!is_array($stackArray)) $stackArray = []; // Fallback por seguridad
            ?>
                
                <div class="project-item group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-100 flex flex-col" 
                     data-categoria="<?php echo htmlspecialchars($proyecto['categoria']); ?>"
                     data-aos="fade-up" 
                     data-aos-delay="<?php echo $index * 50; ?>">
                    
                    <div class="relative h-60 overflow-hidden bg-slate-900">
                        <img src="<?php echo htmlspecialchars($proyecto['img_url']); ?>" alt="<?php echo htmlspecialchars($proyecto['titulo']); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                        
                        <div class="absolute top-4 left-4 bg-black/50 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/10 uppercase tracking-wide">
                            <?php echo htmlspecialchars($proyecto['categoria']); ?>
                        </div>

                        <div class="absolute inset-0 bg-[#0040A8]/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-6 text-center">
                            <span class="text-white font-bold text-lg mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Stack Tecnológico</span>
                            <div class="flex flex-wrap gap-2 justify-center translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">
                                <?php foreach($stackArray as $tech): ?>
                                    <span class="bg-white/20 text-white px-2 py-1 rounded text-xs font-mono"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-[#0040A8] transition-colors"><?php echo htmlspecialchars($proyecto['titulo']); ?></h3>
                            <p class="text-xs text-slate-400 font-mono uppercase tracking-wide">Cliente: <?php echo htmlspecialchars($proyecto['cliente']); ?></p>
                        </div>
                        
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            <?php echo htmlspecialchars($proyecto['descripcion']); ?>
                        </p>

                        <div class="pt-6 border-t border-slate-100 flex justify-between items-center">
                            <div class="flex -space-x-2 overflow-hidden">
                                <div class="inline-block h-6 w-6 rounded-full ring-2 ring-white bg-slate-200"></div>
                                <div class="inline-block h-6 w-6 rounded-full ring-2 ring-white bg-slate-300"></div>
                            </div>
                            <span class="text-[#0040A8] text-xs font-bold cursor-pointer group-hover:underline">
                                Ver Detalles <i class="fas fa-arrow-right ml-1"></i>
                            </span>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
            
            <?php if(empty($proyectos)): ?>
                <div class="col-span-full text-center py-20">
                    <p class="text-slate-400">No hay proyectos cargados en el portafolio aún.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-slate-900 mb-6">¿Tienes una idea similar?</h2>
        <p class="text-slate-500 mb-8">
            Ya sea una web corporativa o una automatización compleja, tenemos el stack y la experiencia para construirlo.
        </p>
        <a href="https://wa.me/584127703302" class="inline-flex items-center justify-center px-8 py-4 bg-[#0040A8] text-white font-bold rounded-xl hover:bg-[#003080] transition-all shadow-lg shadow-blue-900/20 transform hover:-translate-y-1">
            <i class="fab fa-whatsapp mr-2"></i> Cotizar Mi Proyecto
        </a>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filters = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.project-item');

    filters.forEach(btn => {
        btn.addEventListener('click', () => {
            // Reset styles
            filters.forEach(f => {
                f.classList.remove('bg-[#0040A8]', 'text-white', 'shadow-lg');
                f.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            
            // Active style
            btn.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            btn.classList.add('bg-[#0040A8]', 'text-white', 'shadow-lg');

            const filterValue = btn.getAttribute('data-filter');

            items.forEach(item => {
                if(filterValue === 'all' || item.getAttribute('data-categoria') === filterValue) {
                    item.classList.remove('hidden');
                    // Pequeña animación de entrada
                    item.classList.add('fade-in-up');
                    setTimeout(() => item.classList.remove('fade-in-up'), 500);
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
});
</script>

<?php include 'components/footer.php'; ?>