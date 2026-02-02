<?php
$pageTitle = "Nuestros Proyectos";
include 'components/header.php';

// Datos simulados de proyectos (Puedes editarlos aquí mismo)
$proyectos = [
    [
        'titulo' => 'Portal Corporativo "Innova"',
        'categoria' => 'web',
        'descripcion' => 'Diseño web corporativo para firma de abogados, con blog autoadministrable.',
        'img' => 'https://placehold.co/800x600/0040A8/FFFFFF?text=Web+Corporativa' 
    ],
    [
        'titulo' => 'Sistema de Nómina "Visual"',
        'categoria' => 'sistemas',
        'descripcion' => 'Plataforma interna para gestión de pagos, empleados y deducciones legales (IVSS/FAOV).',
        'img' => 'https://placehold.co/800x600/1e293b/FFFFFF?text=Sistema+Nomina'
    ],
    [
        'titulo' => 'E-commerce "Moda Vzla"',
        'categoria' => 'web',
        'descripcion' => 'Tienda en línea con pasarela de pago y gestión de inventario en tiempo real.',
        'img' => 'https://placehold.co/800x600/e2e8f0/0040A8?text=E-Commerce'
    ],
    [
        'titulo' => 'App de Delivery "Rápido"',
        'categoria' => 'app',
        'descripcion' => 'Interfaz de usuario para aplicación móvil de logística y entregas.',
        'img' => 'https://placehold.co/800x600/0040A8/FFFFFF?text=App+Mobile'
    ],
    [
        'titulo' => 'Dashboard Financiero',
        'categoria' => 'sistemas',
        'descripcion' => 'Panel de control administrativo con gráficas y reportes exportables a PDF/Excel.',
        'img' => 'https://placehold.co/800x600/334155/FFFFFF?text=Dashboard'
    ],
    [
        'titulo' => 'Landing Page "Evento 2026"',
        'categoria' => 'web',
        'descripcion' => 'Página de aterrizaje de alta conversión para registro de eventos.',
        'img' => 'https://placehold.co/800x600/f1f5f9/0040A8?text=Landing+Page'
    ]
];
?>

<section class="bg-slate-900 text-white py-20 text-center">
    <div class="max-w-screen-xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4" data-aos="fade-up">Portafolio de Trabajo</h1>
        <p class="text-slate-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Una muestra de cómo transformamos ideas en código limpio y funcional.
        </p>
    </div>
</section>

<section class="py-16 bg-white min-h-screen">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="flex flex-wrap justify-center gap-4 mb-12" data-aos="fade-up">
            <button class="filter-btn active px-6 py-2 rounded-full border border-slate-200 text-slate-600 hover:border-[#0040A8] hover:text-[#0040A8] transition-all font-medium" data-filter="all">Todos</button>
            <button class="filter-btn px-6 py-2 rounded-full border border-slate-200 text-slate-600 hover:border-[#0040A8] hover:text-[#0040A8] transition-all font-medium" data-filter="web">Páginas Web</button>
            <button class="filter-btn px-6 py-2 rounded-full border border-slate-200 text-slate-600 hover:border-[#0040A8] hover:text-[#0040A8] transition-all font-medium" data-filter="sistemas">Sistemas / Apps</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($proyectos as $index => $proyecto): ?>
                <div class="group project-item relative overflow-hidden rounded-xl shadow-lg cursor-pointer" 
                     data-categoria="<?php echo $proyecto['categoria']; ?>"
                     data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                    
                    <div class="overflow-hidden h-64">
                        <img src="<?php echo $proyecto['img']; ?>" alt="<?php echo $proyecto['titulo']; ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    </div>

                    <div class="absolute inset-0 bg-[#0040A8]/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center p-6 text-center text-white">
                        <h3 class="text-xl font-bold mb-2 translate-y-4 group-hover:translate-y-0 transition-transform duration-300"><?php echo $proyecto['titulo']; ?></h3>
                        <p class="text-sm text-blue-100 mb-4 translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75"><?php echo $proyecto['descripcion']; ?></p>
                        <span class="inline-block border border-white px-4 py-1 rounded-full text-xs uppercase tracking-wider translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-100">Ver Detalles</span>
                    </div>
                    
                    <div class="absolute bottom-0 left-0 w-full bg-white p-4 md:hidden">
                        <h3 class="font-bold text-slate-800"><?php echo $proyecto['titulo']; ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const filters = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.project-item');

    filters.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remover clase activa
            filters.forEach(f => f.classList.remove('bg-[#0040A8]', 'text-white', 'border-transparent'));
            filters.forEach(f => f.classList.add('text-slate-600', 'border-slate-200'));
            
            // Activar botón actual
            btn.classList.remove('text-slate-600', 'border-slate-200');
            btn.classList.add('bg-[#0040A8]', 'text-white', 'border-transparent');

            const filterValue = btn.getAttribute('data-filter');

            items.forEach(item => {
                if(filterValue === 'all' || item.getAttribute('data-categoria') === filterValue) {
                    item.style.display = 'block';
                    // Re-trigger animación (opcional, simple display block funciona bien)
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Activar el primero por defecto visualmente
    document.querySelector('.filter-btn[data-filter="all"]').click();
});
</script>

<?php include 'components/footer.php'; ?>