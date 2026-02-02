<?php 
$pageTitle = "Inicio"; // Título de la pestaña
include 'components/header.php'; 
?>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="absolute inset-0 -z-10 h-full w-full bg-gradient-to-b from-white via-transparent to-white"></div>

    <div class="max-w-screen-xl mx-auto px-4 text-center">
        
        <div data-aos="fade-down" class="inline-flex items-center gap-x-2 rounded-full border border-blue-100 bg-blue-50 px-4 py-1.5 text-sm font-medium text-[#0040A8] mb-8">
            <span class="flex h-2 w-2 rounded-full bg-[#0040A8] animate-pulse"></span>
            Agencia de Desarrollo & Software
        </div>

        <h1 data-aos="fade-up" data-aos-delay="100" class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
            Tu Departamento de Tecnología, <br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0040A8] to-blue-500">sin complicaciones.</span>
        </h1>

        <p data-aos="fade-up" data-aos-delay="200" class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            Diseñamos páginas web, aplicaciones y sistemas a medida bajo un modelo de suscripción mensual. Olvídate de los costes ocultos y enfócate en crecer.
        </p>

        <div data-aos="fade-up" data-aos-delay="300" class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="servicios.php" class="w-full sm:w-auto px-8 py-4 bg-[#0040A8] text-white font-bold rounded-xl hover:bg-[#003080] transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-900/20">
                Ver Planes y Precios
            </a>
            <a href="portafolio.php" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-50 transition-all hover:border-[#0040A8] hover:text-[#0040A8]">
                Ver Proyectos
            </a>
        </div>
    </div>
</section>

<section class="py-10 border-y border-slate-100 bg-slate-50/50">
    <div class="max-w-screen-xl mx-auto px-4">
        <p class="text-center text-sm font-semibold text-slate-400 uppercase tracking-widest mb-6">Tecnologías que dominamos</p>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
            <i class="fab fa-php text-4xl hover:text-[#0040A8] transition-colors" title="PHP"></i>
            <i class="fab fa-js text-4xl hover:text-yellow-400 transition-colors" title="JavaScript"></i>
            <i class="fab fa-html5 text-4xl hover:text-orange-500 transition-colors" title="HTML5"></i>
            <i class="fab fa-css3-alt text-4xl hover:text-blue-500 transition-colors" title="CSS3"></i>
            <i class="fas fa-database text-4xl hover:text-slate-600 transition-colors" title="SQL"></i>
            <i class="fab fa-wordpress text-4xl hover:text-blue-900 transition-colors" title="WordPress"></i>
        </div>
    </div>
</section>

<section class="py-24 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            
            <div data-aos="fade-right">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">
                    No vendemos código,<br> vendemos <span class="text-[#0040A8]">resultados continuos.</span>
                </h2>
                <p class="text-slate-600 mb-6 text-lg">
                    Muchas agencias te entregan una web y desaparecen. En <strong>Viiu Studio</strong>, trabajamos como tu socio tecnológico a largo plazo.
                </p>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1 mr-3">
                            <i class="fas fa-check text-xs text-[#0040A8]"></i>
                        </div>
                        <span class="text-slate-700"><strong>Sin inversión inicial gigante:</strong> Pagas una suscripción mensual cómoda, como pagar la luz o el internet.</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1 mr-3">
                            <i class="fas fa-check text-xs text-[#0040A8]"></i>
                        </div>
                        <span class="text-slate-700"><strong>Mantenimiento Incluido:</strong> Tu web nunca quedará obsoleta. Nosotros la cuidamos.</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center mt-1 mr-3">
                            <i class="fas fa-check text-xs text-[#0040A8]"></i>
                        </div>
                        <span class="text-slate-700"><strong>Escalabilidad:</strong> ¿Empiezas pequeño? Bien. ¿Creces mañana? Mejoramos tu plan al instante.</span>
                    </li>
                </ul>

                <a href="contacto.php" class="text-[#0040A8] font-bold hover:underline inline-flex items-center group">
                    Hablemos de tu idea 
                    <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="relative" data-aos="fade-left">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-blue-50 rounded-full blur-3xl -z-10 opacity-70"></div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="glass-card p-6 rounded-2xl shadow-sm transform translate-y-8">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-[#0040A8] mb-4">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="font-bold text-slate-800">Landing Pages</h3>
                        <p class="text-sm text-slate-500 mt-2">Diseños que convierten visitas en clientes.</p>
                    </div>
                    <div class="glass-card p-6 rounded-2xl shadow-sm bg-[#0040A8] text-white">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center text-white mb-4">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="font-bold">Sistemas Web</h3>
                        <p class="text-sm text-blue-100 mt-2">Gestión, inventarios y dashboards a medida.</p>
                    </div>
                    <div class="glass-card p-6 rounded-2xl shadow-sm col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-slate-800">Soporte Dedicado</h3>
                            <span class="text-green-500 text-xs font-bold bg-green-100 px-2 py-1 rounded">Activo</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 mb-2">
                            <div class="bg-[#0040A8] h-2 rounded-full" style="width: 100%"></div>
                        </div>
                        <p class="text-xs text-slate-500">Siempre disponibles para resolver dudas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute w-96 h-96 bg-[#0040A8] rounded-full blur-[100px] opacity-30 -top-20 -left-20"></div>
        <div class="absolute w-96 h-96 bg-purple-900 rounded-full blur-[100px] opacity-30 bottom-0 right-0"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6">¿Listo para digitalizar tu negocio?</h2>
        <p class="text-slate-300 text-lg mb-8">
            Únete a Viiu Studio hoy. Sin contratos forzosos a largo plazo, solo resultados mes a mes.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/584120000000" class="px-8 py-4 bg-[#0040A8] hover:bg-[#003080] rounded-xl font-bold transition-all shadow-lg shadow-blue-900/50">
                <i class="fab fa-whatsapp mr-2"></i> Iniciar Chat
            </a>
            <a href="contacto.php" class="px-8 py-4 bg-transparent border border-white/20 hover:bg-white/10 rounded-xl font-bold transition-all">
                Contáctanos
            </a>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>