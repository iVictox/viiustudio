<?php
$pageTitle = "Planes y Servicios";
include 'components/header.php';
?>

<section class="bg-[#0040A8] text-white py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:20px_20px]"></div>
    
    <div class="max-w-screen-xl mx-auto px-4 text-center relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up">Elige tu tranquilidad tecnológica</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Planes mensuales transparentes. Sin sorpresas. Todo incluido: desarrollo, servidores, dominios y soporte.
        </p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            
            <?php 
            $delay = 0;
            foreach ($planes as $key => $plan): 
                $isRecommended = $plan['recomendado'];
                $delay += 100;
            ?>
            
            <div data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>" 
                 class="relative flex flex-col p-8 bg-white rounded-2xl shadow-lg transition-transform hover:-translate-y-2 border border-slate-100 <?php echo $isRecommended ? 'ring-2 ring-[#0040A8] md:-mt-8 md:mb-8' : ''; ?>">
                
                <?php if($isRecommended): ?>
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-[#0040A8] text-white px-4 py-1 rounded-full text-sm font-bold tracking-wide uppercase shadow-md">
                        Más Popular
                    </div>
                <?php endif; ?>

                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-slate-800"><?php echo $plan['titulo']; ?></h3>
                    <p class="text-slate-500 text-sm mt-2 h-10"><?php echo $plan['subtitulo']; ?></p>
                </div>

                <div class="mb-6 flex items-baseline text-slate-900">
                    <?php if(is_numeric($plan['precio'])): ?>
                        <span class="text-5xl font-extrabold tracking-tight">$<?php echo $plan['precio']; ?></span>
                        <span class="ml-1 text-xl font-normal text-slate-500">/mes</span>
                    <?php else: ?>
                        <span class="text-4xl font-extrabold tracking-tight"><?php echo $plan['precio']; ?></span>
                    <?php endif; ?>
                </div>

                <ul class="mb-8 space-y-4 flex-1">
                    <?php foreach($plan['features'] as $feature): ?>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-100 text-green-600 flex items-center justify-center mt-0.5">
                            <i class="fas fa-check text-xs"></i>
                        </div>
                        <span class="ml-3 text-slate-600 text-sm"><?php echo $feature; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <a href="https://wa.me/584120000000?text=Hola,%20me%20interesa%20el%20plan%20<?php echo urlencode($plan['titulo']); ?>" 
                   target="_blank"
                   class="w-full block text-center py-3 px-6 rounded-lg font-bold transition-colors <?php echo $isRecommended ? 'bg-[#0040A8] text-white hover:bg-[#003080]' : 'bg-slate-100 text-[#0040A8] hover:bg-slate-200'; ?>">
                    Elegir Plan
                </a>
            </div>
            
            <?php endforeach; ?>
            
        </div>

        <p class="text-center text-slate-400 text-sm mt-12 italic">
            * Los precios pueden variar según la complejidad específica de requerimientos adicionales. Contáctanos para una cotización personalizada.
        </p>

    </div>
</section>

<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-slate-900">¿Cómo empezamos a trabajar?</h2>
            <p class="text-slate-500 mt-4">Simple, directo y sin burocracia innecesaria.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#0040A8] text-2xl font-bold mb-6 group-hover:bg-[#0040A8] group-hover:text-white transition-colors duration-300">
                    1
                </div>
                <h3 class="font-bold text-lg mb-2">Consulta Gratis</h3>
                <p class="text-slate-500 text-sm">Hablamos por WhatsApp o llamada para entender qué necesita tu negocio.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#0040A8] text-2xl font-bold mb-6 group-hover:bg-[#0040A8] group-hover:text-white transition-colors duration-300">
                    2
                </div>
                <h3 class="font-bold text-lg mb-2">Propuesta & Plan</h3>
                <p class="text-slate-500 text-sm">Te recomendamos el plan ideal y definimos el alcance del proyecto.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#0040A8] text-2xl font-bold mb-6 group-hover:bg-[#0040A8] group-hover:text-white transition-colors duration-300">
                    3
                </div>
                <h3 class="font-bold text-lg mb-2">Desarrollo Rápido</h3>
                <p class="text-slate-500 text-sm">Creamos tu plataforma. Te mostramos avances y ajustamos detalles.</p>
            </div>

            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-[#0040A8] text-2xl font-bold mb-6 group-hover:bg-[#0040A8] group-hover:text-white transition-colors duration-300">
                    4
                </div>
                <h3 class="font-bold text-lg mb-2">Lanzamiento</h3>
                <p class="text-slate-500 text-sm">Publicamos tu web. A partir de aquí, nosotros nos encargamos de que siempre funcione.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-screen-md mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Preguntas Frecuentes</h2>
        
        <div class="space-y-4">
            <div class="bg-white rounded-lg p-6 shadow-sm cursor-pointer hover:shadow-md transition-shadow">
                <h4 class="font-bold text-[#0040A8] mb-2">¿Qué incluye el mantenimiento mensual?</h4>
                <p class="text-slate-600 text-sm">Incluye actualizaciones de seguridad, corrección de errores, cambios menores en textos o imágenes, copias de seguridad y monitoreo para asegurar que tu sitio esté siempre en línea.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm cursor-pointer hover:shadow-md transition-shadow">
                <h4 class="font-bold text-[#0040A8] mb-2">¿Puedo cancelar cuando quiera?</h4>
                <p class="text-slate-600 text-sm">Sí. Trabajamos mes a mes. Si decides cancelar, te entregamos una copia de tu base de datos y contenido (según términos del contrato), aunque el código fuente de nuestra plataforma base sigue siendo propiedad de Viiu Studio.</p>
            </div>

             <div class="bg-white rounded-lg p-6 shadow-sm cursor-pointer hover:shadow-md transition-shadow">
                <h4 class="font-bold text-[#0040A8] mb-2">¿Hacen sistemas complejos a medida?</h4>
                <p class="text-slate-600 text-sm">¡Absolutamente! Es nuestra especialidad. Desde sistemas de nómina, control de inventarios hasta apps internas para empresas. Contáctanos para el Plan Pro.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>