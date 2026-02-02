<?php
$pageTitle = "Contáctanos";
include 'components/header.php';
?>

<section class="relative bg-slate-50 min-h-screen py-20">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-[#0040A8]/5 skew-x-12 hidden lg:block"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <div data-aos="fade-right">
                <h4 class="text-[#0040A8] font-bold tracking-wider uppercase mb-2">Hablemos de negocios</h4>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mb-6">¿Tienes un proyecto en mente?</h1>
                <p class="text-lg text-slate-600 mb-8">
                    Ya sea que necesites una landing page rápida o un sistema complejo a medida, en Viiu Studio estamos listos para empezar.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-white shadow-md rounded-lg flex items-center justify-center text-[#0040A8] text-xl shrink-0">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-slate-800">WhatsApp Directo</h3>
                            <p class="text-slate-500 text-sm mb-1">Respuesta inmediata (9am - 6pm)</p>
                            <a href="<?php echo $info['whatsapp_link']; ?>" class="text-[#0040A8] font-medium hover:underline">Iniciar Chat &rarr;</a>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-white shadow-md rounded-lg flex items-center justify-center text-[#0040A8] text-xl shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-slate-800">Correo Electrónico</h3>
                            <p class="text-slate-500 text-sm mb-1">Para propuestas formales</p>
                            <a href="mailto:<?php echo $info['email']; ?>" class="text-[#0040A8] font-medium hover:underline"><?php echo $info['email']; ?></a>
                        </div>
                    </div>
                </div>

                <div class="mt-12 p-6 bg-[#0040A8] rounded-2xl text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="font-bold text-xl mb-2">Desde Venezuela para el mundo 🇻🇪</h3>
                        <p class="text-blue-200 text-sm">Ofrecemos servicios de desarrollo con calidad internacional y precios competitivos.</p>
                    </div>
                    <i class="fas fa-globe-americas absolute -bottom-4 -right-4 text-9xl text-white opacity-10"></i>
                </div>
            </div>

            <div data-aos="fade-left">
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-xl border border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6">Envíanos un mensaje</h3>
                    
                    <form action="#" method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="w-full px-4 py-3 rounded-lg bg-slate-50 border-slate-200 focus:border-[#0040A8] focus:ring-[#0040A8] focus:ring-1 outline-none transition-all" placeholder="Tu nombre">
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-slate-700 mb-1">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" class="w-full px-4 py-3 rounded-lg bg-slate-50 border-slate-200 focus:border-[#0040A8] focus:ring-[#0040A8] focus:ring-1 outline-none transition-all" placeholder="+58 ...">
                            </div>
                        </div>

                        <div>
                            <label for="servicio" class="block text-sm font-medium text-slate-700 mb-1">Servicio de interés</label>
                            <select id="servicio" name="servicio" class="w-full px-4 py-3 rounded-lg bg-slate-50 border-slate-200 focus:border-[#0040A8] focus:ring-[#0040A8] focus:ring-1 outline-none transition-all">
                                <option value="" disabled selected>Selecciona una opción</option>
                                <option value="landing">Landing Page (Básico)</option>
                                <option value="web">Sitio Web Corporativo (Estándar)</option>
                                <option value="sistema">Sistema a Medida (Pro)</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div>
                            <label for="mensaje" class="block text-sm font-medium text-slate-700 mb-1">Detalles del proyecto</label>
                            <textarea id="mensaje" name="mensaje" rows="4" class="w-full px-4 py-3 rounded-lg bg-slate-50 border-slate-200 focus:border-[#0040A8] focus:ring-[#0040A8] focus:ring-1 outline-none transition-all" placeholder="Cuéntanos un poco sobre lo que necesitas..."></textarea>
                        </div>

                        <button type="button" onclick="window.location.href='<?php echo $info['whatsapp_link']; ?>'" class="w-full py-4 bg-[#0040A8] text-white font-bold rounded-xl hover:bg-[#003080] transition-all shadow-lg shadow-blue-900/20 transform hover:-translate-y-1">
                            Enviar Mensaje
                        </button>
                        
                        <p class="text-center text-xs text-slate-400 mt-4">
                            Al enviar este formulario aceptas nuestra política de privacidad.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>