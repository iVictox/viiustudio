<?php
// index.php - Rediseño Profesional Minimalista
$pageTitle = "Inicio"; 
include 'components/header.php';
?>

<section class="relative pt-32 pb-24 lg:pt-48 lg:pb-40 overflow-hidden bg-slate-900 flex items-center min-h-[90vh]">
    
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0h-2.828zM43.314 0L47.97 4.657l-1.414 1.414L40.486 0h2.828zM16.686 0L12.03 4.657 13.443 6.07 19.514 0h-2.828zM37.657 0l4.657 4.657-1.414 1.414L34.83 0h2.827zM22.343 0L17.686 4.657 19.1 6.07 25.172 0h-2.83zM32 0l.83.828-1.415 1.415L30 0h2zM28 0l-.83.828L28.585 2.243 30 0h-2z\' fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');"></div>
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[#0040A8] rounded-full opacity-10 blur-3xl animate-pulse"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 w-full">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <div data-aos="fade-right" class="text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-300 text-sm font-mono mb-8">
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-ping"></span>
                    Viiu Studio v1.0 -> Online
                </div>

                <h1 class="text-5xl lg:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    Tu Socio <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Tecnológico.</span>
                </h1>
                
                <p class="text-xl text-slate-400 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    No somos otra agencia más. Somos tu departamento de <strong>Desarrollo & Automatización</strong> externalizado. Creamos sistemas que trabajan por ti.
                </p>

                <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                    <a href="servicios.php" class="px-8 py-4 bg-[#0040A8] hover:bg-blue-600 text-white font-bold rounded-xl transition-all transform hover:scale-105 hover:shadow-lg shadow-blue-500/20 flex items-center gap-3">
                        <i class="fas fa-code-branch"></i>
                        Explorar Soluciones
                    </a>
                    <a href="#contacto" class="px-8 py-4 bg-transparent border-2 border-slate-700 text-slate-300 font-bold rounded-xl hover:bg-slate-800 hover:text-white transition-all">
                        Agendar Demo
                    </a>
                </div>
            </div>

            <div data-aos="fade-left" data-aos-delay="200" class="hidden lg:block relative group">
                <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                
                <div class="relative bg-[#0a0e17] rounded-2xl border border-slate-800 shadow-2xl overflow-hidden font-mono text-sm p-6">
                    <div class="flex items-center gap-2 mb-4 border-b border-slate-800 pb-4">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <span class="text-slate-500 ml-2 flex-1 text-center pr-10">~/viiu-studio/automations/sales-bot.js</span>
                    </div>
                    
                    <div class="text-slate-300 space-y-1">
                        <div class="flex"><span class="text-blue-400 mr-2">const</span> client = <span class="text-yellow-300">new</span> Client();</div>
                        <div class="flex"><span class="text-blue-400 mr-2">const</span> crm = <span class="text-yellow-300">require</span>(<span class="text-green-300">'./crm-connector'</span>);</div>
                        <div><br></div>
                        <div class="text-slate-500">// Escuchando nuevos mensajes...</div>
                        <div>client.on(<span class="text-green-300">'message'</span>, <span class="text-blue-400">async</span> (msg) => {</div>
                        <div class="pl-4">
                             <span class="text-purple-400">if</span> (msg.body === <span class="text-green-300">'Info Precio'</span>) {
                        </div>
                        <div class="pl-8 text-slate-500">// 1. Respuesta automática 24/7</div>
                        <div class="pl-8">await msg.reply(<span class="text-green-300">'¡Hola! Envío catálogo PDF...'</span>);</div>
                        <div class="pl-8 text-slate-500 mt-2">// 2. Guardar lead en el sistema</div>
                        <div class="pl-8">await crm.saveLead({ phone: msg.from, status: <span class="text-green-300">'Interested'</span> });</div>
                        <div class="pl-8"><span class="text-cyan-400">console</span>.log(<span class="text-green-300">'> Nuevo lead procesado y guardado.'</span>);</div>
                        <div class="pl-4">}</div>
                        <div>});</div>
                        <div class="mt-4 flex items-center">
                            <span class="text-green-400 mr-2">➜</span> <span class="animate-pulse">_</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-10 bg-white border-b border-slate-100 overflow-hidden">
    <div class="max-w-screen-xl mx-auto px-4 mb-6">
       <p class="text-center text-sm font-bold uppercase tracking-widest text-slate-400">Creamos con tecnología moderna</p>
    </div>
    
    <div class="flex justify-between items-center gap-8 max-w-4xl mx-auto opacity-60 grayscale hover:grayscale-0 transition-all duration-500 px-4 overflow-x-auto md:overflow-visible no-scrollbar">
        <i class="fab fa-php text-5xl hover:text-[#777BB4] transition-colors" title="PHP"></i>
        <i class="fab fa-laravel text-5xl hover:text-[#FF2D20] transition-colors" title="Laravel"></i>
        <i class="fab fa-node-js text-5xl hover:text-[#339933] transition-colors" title="Node.js"></i>
        <i class="fab fa-react text-5xl hover:text-[#61DAFB] transition-colors" title="React"></i>
        <i class="fab fa-vuejs text-5xl hover:text-[#4FC08D] transition-colors" title="Vue.js"></i>
        <i class="fas fa-database text-5xl hover:text-[#00758F] transition-colors" title="MySQL/SQL"></i>
        <i class="fab fa-docker text-5xl hover:text-[#2496ED] transition-colors" title="Docker"></i>
        <i class="fas fa-bolt text-5xl hover:text-yellow-500 transition-colors" title="Automation workflows"></i>
    </div>
</section>


<section class="py-24 bg-slate-50">
    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-4xl font-extrabold text-slate-900 mb-4">Nuestros Pilares</h2>
            <p class="text-slate-600 max-w-xl mx-auto text-lg">
                Simplificamos la tecnología en tres áreas clave para el crecimiento de tu negocio.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-10">
            <a href="servicios.php#web" class="group bg-white rounded-[2rem] p-10 shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 hover:border-blue-100 relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:bg-[#0040A8] opacity-50 group-hover:opacity-10"></div>
                
                <div class="w-16 h-16 bg-blue-50 text-[#0040A8] rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-[#0040A8] transition-colors">Desarrollo Web</h3>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Sitios corporativos y tiendas online de alto rendimiento. Velocidad, SEO y diseño que convierte visitantes en clientes.
                </p>
                 <span class="inline-flex items-center font-bold text-[#0040A8] group-hover:underline">
                    Ver Planes <i class="fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-2 transition-transform"></i>
                </span>
            </a>

            <a href="servicios.php#sistemas" class="group bg-white rounded-[2rem] p-10 shadow-sm hover:shadow-2xl transition-all duration-300 border border-slate-100 hover:border-blue-100 relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:bg-[#0040A8] opacity-50 group-hover:opacity-10"></div>

                <div class="w-16 h-16 bg-blue-50 text-[#0040A8] rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-slate-900 group-hover:text-[#0040A8] transition-colors">Sistemas a Medida (SaaS)</h3>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Olvida el Excel. Desarrollamos tu propio software administrativo, CRM o ERP en la nube, adaptado 100% a tus reglas de negocio.
                </p>
                 <span class="inline-flex items-center font-bold text-[#0040A8] group-hover:underline">
                    Ver Planes <i class="fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-2 transition-transform"></i>
                </span>
            </a>

            <a href="servicios.php#automatizacion" class="group bg-[#0040A8] rounded-[2rem] p-10 shadow-xl hover:shadow-2xl transition-all duration-300 border border-blue-900 relative overflow-hidden text-white ring-4 ring-blue-50/50" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');"></div>
                
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm text-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-inner group-hover:scale-110 transition-transform">
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-white">Automatización</h3>
                <p class="text-blue-100 leading-relaxed mb-8">
                    Conectamos tus apps (WhatsApp, Bancos, Email) para crear flujos de trabajo autónomos. Ahorra cientos de horas hombre.
                </p>
                 <span class="inline-flex items-center font-bold text-white group-hover:underline">
                    Ver Ejemplos <i class="fas fa-arrow-right ml-2 text-sm transform group-hover:translate-x-2 transition-transform"></i>
                </span>
            </a>
        </div>
    </div>
</section>


<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-screen-md mx-auto px-4 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 mb-16" data-aos="fade-up">Cómo trabajamos</h2>
        
        <div class="relative">
            <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-slate-100 -translate-y-1/2 z-0"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-6">
                    <div class="w-16 h-16 mx-auto bg-white border-4 border-blue-100 text-[#0040A8] rounded-full flex items-center justify-center text-2xl font-bold mb-6 relative">
                        1
                        <span class="absolute -inset-2 rounded-full bg-blue-50 opacity-50 animate-pulse z-[-1]"></span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Análisis</h3>
                    <p class="text-slate-500 text-sm">Entendemos tus procesos manuales y puntos de dolor.</p>
                </div>
                 <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-6">
                    <div class="w-16 h-16 mx-auto bg-white border-4 border-blue-100 text-[#0040A8] rounded-full flex items-center justify-center text-2xl font-bold mb-6">
                        2
                    </div>
                    <h3 class="text-lg font-bold mb-2">Desarrollo</h3>
                    <p class="text-slate-500 text-sm">Creamos el software o configuramos los flujos de automatización.</p>
                </div>
                 <div data-aos="fade-up" data-aos-delay="500" class="bg-white p-6">
                    <div class="w-16 h-16 mx-auto bg-white border-4 border-blue-100 text-[#0040A8] rounded-full flex items-center justify-center text-2xl font-bold mb-6">
                        3
                    </div>
                    <h3 class="text-lg font-bold mb-2">Despliegue</h3>
                    <p class="text-slate-500 text-sm">Tu sistema empieza a funcionar y te damos soporte continuo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>