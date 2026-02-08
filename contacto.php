<?php
// contacto.php - Diseño "Connection Protocol"
$pageTitle = "Iniciar Proyecto";
include 'components/header.php';
?>

<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-900 text-white">
    
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#0040A8 1px, transparent 1px); background-size: 40px 40px;"></div>
    
    <div class="absolute top-1/2 right-0 -translate-y-1/2 w-[500px] h-[500px] bg-[#0040A8] opacity-20 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-12 items-center">
        
        <div data-aos="fade-right">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-900/30 border border-green-500/30 text-green-400 text-xs font-mono mb-6">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                Status: Accepting New Projects
            </div>
            
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Ejecuta tu <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Siguiente Paso.</span>
            </h1>
            
            <p class="text-lg text-slate-400 mb-8 max-w-lg leading-relaxed">
                Ya sea que tengas una especificación técnica detallada o solo una idea en una servilleta, estamos listos para compilarla.
            </p>

            <div class="space-y-4 font-mono text-sm">
                <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/50 transition-colors group cursor-pointer" onclick="window.open('<?php echo $info['whatsapp_link']; ?>')">
                    <div class="w-10 h-10 rounded-lg bg-green-600/20 text-green-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="text-slate-500 text-xs uppercase tracking-wider">Direct Channel (Fastest)</div>
                        <div class="text-white font-bold group-hover:text-green-400 transition-colors">Iniciar Chat en WhatsApp</div>
                    </div>
                    <i class="fas fa-external-link-alt ml-auto text-slate-600 group-hover:text-white"></i>
                </div>

                <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/10 hover:border-blue-500/50 transition-colors group cursor-pointer" onclick="window.location.href='mailto:<?php echo $info['email']; ?>'">
                    <div class="w-10 h-10 rounded-lg bg-blue-600/20 text-blue-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <div class="text-slate-500 text-xs uppercase tracking-wider">Async Protocol</div>
                        <div class="text-white font-bold group-hover:text-blue-400 transition-colors"><?php echo $info['email']; ?></div>
                    </div>
                    <i class="fas fa-copy ml-auto text-slate-600 group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <div data-aos="fade-left" class="hidden lg:flex justify-center relative">
            <div class="relative w-full max-w-md aspect-square bg-slate-800/50 rounded-2xl border border-slate-700 p-6 flex flex-col shadow-2xl backdrop-blur-sm">
                <div class="flex gap-2 mb-6 border-b border-slate-700 pb-4">
                    <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                    <div class="w-3 h-3 rounded-full bg-slate-600"></div>
                </div>
                <div class="flex-1 font-mono text-xs text-slate-400 space-y-2 overflow-hidden">
                    <p><span class="text-purple-400">class</span> <span class="text-yellow-300">Project</span> {</p>
                    <p class="pl-4"><span class="text-blue-400">constructor</span>(idea) {</p>
                    <p class="pl-8"><span class="text-red-400">this</span>.status = <span class="text-green-300">'Pending'</span>;</p>
                    <p class="pl-8"><span class="text-red-400">this</span>.goal = <span class="text-green-300">'Success'</span>;</p>
                    <p class="pl-4">}</p>
                    <br>
                    <p class="pl-4"><span class="text-blue-400">init</span>() {</p>
                    <p class="pl-8 text-slate-500">// Waiting for user input...</p>
                    <p class="pl-8"><span class="text-cyan-400">ViiuStudio</span>.contact(<span class="text-red-400">this</span>);</p>
                    <p class="pl-4">}</p>
                    <p>}</p>
                </div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-[#0040A8] rounded-full blur-[40px] opacity-60"></div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50 relative -mt-10 rounded-t-[3rem] z-20">
    <div class="max-w-screen-xl mx-auto px-4">
        
        <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-slate-100 max-w-4xl mx-auto relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#0040A8] to-cyan-400"></div>

            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900">Formulario de Contacto</h2>
                <p class="text-slate-500 mt-2">Completa los campos para generar tu solicitud automática.</p>
            </div>

            <form id="contactForm" class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group">
                        <label for="nombre" class="block text-sm font-bold text-slate-700 mb-2 group-hover:text-[#0040A8] transition-colors">Nombre Completo</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-[#0040A8] transition-colors"></i>
                            <input type="text" id="nombre" name="nombre" required class="w-full pl-12 pr-4 py-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#0040A8] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium" placeholder="Tu nombre o empresa">
                        </div>
                    </div>

                    <div class="group">
                        <label for="contacto" class="block text-sm font-bold text-slate-700 mb-2 group-hover:text-[#0040A8] transition-colors">Email o WhatsApp</label>
                        <div class="relative">
                            <i class="fas fa-paper-plane absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-[#0040A8] transition-colors"></i>
                            <input type="text" id="contacto" name="contacto" required class="w-full pl-12 pr-4 py-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#0040A8] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium" placeholder="Método de contacto">
                        </div>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 mb-4 group-hover:text-[#0040A8] transition-colors">¿En qué área necesitas ayuda?</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="servicio" value="Desarrollo Web" class="peer sr-only" checked>
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 peer-checked:bg-[#0040A8] peer-checked:text-white flex items-center justify-center transition-colors">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <span class="font-bold text-slate-700 peer-checked:text-[#0040A8]">Web Dev</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="servicio" value="Sistemas a Medida" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 peer-checked:bg-[#0040A8] peer-checked:text-white flex items-center justify-center transition-colors">
                                    <i class="fas fa-database"></i>
                                </div>
                                <span class="font-bold text-slate-700 peer-checked:text-[#0040A8]">Sistemas</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="servicio" value="Automatización" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 peer-checked:bg-[#0040A8] peer-checked:text-white flex items-center justify-center transition-colors">
                                    <i class="fas fa-robot"></i>
                                </div>
                                <span class="font-bold text-slate-700 peer-checked:text-[#0040A8]">Automata</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="group">
                    <label for="mensaje" class="block text-sm font-bold text-slate-700 mb-2 group-hover:text-[#0040A8] transition-colors">Detalles del Proyecto</label>
                    <textarea id="mensaje" name="mensaje" rows="4" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#0040A8] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium resize-none" placeholder="Cuéntanos brevemente qué necesitas automatizar o desarrollar..."></textarea>
                </div>

                <button type="submit" class="w-full py-5 bg-[#0040A8] text-white font-bold rounded-xl hover:bg-[#003080] transition-all shadow-lg shadow-blue-900/20 transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg group">
                    <span>Enviar Solicitud</span>
                    <i class="fab fa-whatsapp text-2xl group-hover:rotate-12 transition-transform"></i>
                </button>
                
                <p class="text-center text-xs text-slate-400">
                    <i class="fas fa-lock mr-1"></i> Tus datos están protegidos bajo estricto secreto profesional.
                </p>
            </form>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 max-w-4xl mx-auto">
            <div class="text-center p-6">
                <i class="fas fa-clock text-3xl text-slate-300 mb-3"></i>
                <h4 class="font-bold text-slate-800">Respuesta Rápida</h4>
                <p class="text-sm text-slate-500">Solemos responder en menos de 2 horas en horario laboral.</p>
            </div>
            <div class="text-center p-6 border-x border-slate-100">
                <i class="fas fa-globe-americas text-3xl text-slate-300 mb-3"></i>
                <h4 class="font-bold text-slate-800">Servicio Global</h4>
                <p class="text-sm text-slate-500">Trabajamos con clientes de toda Latinoamérica y España.</p>
            </div>
             <div class="text-center p-6">
                <i class="fas fa-file-contract text-3xl text-slate-300 mb-3"></i>
                <h4 class="font-bold text-slate-800">Sin Compromiso</h4>
                <p class="text-sm text-slate-500">La primera consultoría de análisis es 100% gratuita.</p>
            </div>
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    
    form.addEventListener('submit', (e) => {
        e.preventDefault(); 


        const nombre = document.getElementById('nombre').value;
        const contacto = document.getElementById('contacto').value;
        const servicio = document.querySelector('input[name="servicio"]:checked').value;
        const mensaje = document.getElementById('mensaje').value;

        if(!nombre || !contacto) {
            alert('Por favor, indica tu nombre y un método de contacto.');
            return;
        }
        
        let text = `🚀 *Nuevo Lead desde la Web ViiuStudio* %0A`;
        text += `---------------------------------%0A`;
        text += `👤 *Nombre:* ${nombre}%0A`;
        text += `📞 *Contacto:* ${contacto}%0A`;
        text += `🛠 *Interés:* ${servicio}%0A`;
        text += `📝 *Mensaje:* ${mensaje}`;

        const myNumber = "584127703302"; 

        const url = `https://wa.me/${myNumber}?text=${text}`;


        window.open(url, '_blank');

        form.reset();
    });
});
</script>

<?php include 'components/footer.php'; ?>