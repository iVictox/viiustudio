<?php
// contacto.php - Con Notificación "Toast" Personalizada
$pageTitle = "Iniciar Proyecto";
include 'components/header.php';
?>

<section class="relative min-h-screen flex items-center pt-28 pb-20 overflow-hidden bg-slate-900">
    
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#0040A8 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-[#0040A8] opacity-20 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 -translate-x-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-cyan-500 opacity-10 blur-[100px] rounded-full pointer-events-none translate-y-1/2 translate-x-1/2"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10 w-full">
        
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col justify-center h-full" data-aos="fade-right">
                
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-900/30 border border-blue-500/30 text-blue-300 text-xs font-mono mb-6 w-fit">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    Status: Online & Ready
                </div>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    Hablemos de <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Tu Futuro.</span>
                </h1>
                
                <p class="text-slate-400 text-lg mb-10 leading-relaxed">
                    Déjanos tus datos en el formulario y te contactaremos para analizar tu proyecto, o utiliza nuestros canales directos para una respuesta inmediata.
                </p>

                <div class="space-y-4">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Canales Directos</p>
                    
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:border-green-500/50 hover:bg-white/10 transition-all group cursor-pointer" onclick="window.open('<?php echo $info['whatsapp_link']; ?>')">
                        <div class="w-12 h-12 rounded-xl bg-green-600/20 text-green-400 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-lg shadow-green-900/20">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <div class="text-slate-400 text-xs uppercase tracking-wider font-mono">Chat Inmediato</div>
                            <div class="text-white font-bold text-lg group-hover:text-green-400 transition-colors">Iniciar WhatsApp</div>
                        </div>
                        <i class="fas fa-chevron-right ml-auto text-slate-600 group-hover:text-white transition-colors"></i>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-white/10 transition-all group relative">
                        <div class="flex items-center gap-4 flex-1 cursor-pointer" onclick="window.location.href='mailto:<?php echo $info['email']; ?>'">
                            <div class="w-12 h-12 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform shadow-lg shadow-blue-900/20">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <div class="text-slate-400 text-xs uppercase tracking-wider font-mono">Correo Corporativo</div>
                                <div class="text-white font-bold text-lg group-hover:text-blue-400 transition-colors"><?php echo $info['email']; ?></div>
                            </div>
                        </div>
                        
                        <button onclick="copyToClipboard('<?php echo $info['email']; ?>')" class="w-10 h-10 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white transition-colors flex items-center justify-center z-10 border border-slate-700" title="Copiar correo">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 order-1 lg:order-2" data-aos="fade-left">
                <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-slate-700/50 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#0040A8] to-cyan-400"></div>

                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Envíanos una solicitud</h2>
                    <p class="text-slate-500 text-sm mb-6">Te responderemos en menos de 24 horas.</p>

                    <form id="contactForm" class="space-y-6">
                        
                        <div class="group">
                            <label for="nombre" class="block text-sm font-bold text-slate-700 mb-2">Nombre / Empresa</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="text" id="nombre" name="nombre" required class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#0040A8] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium" placeholder="Tu nombre o negocio">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Método de contacto preferido</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="preferencia_contacto" value="email" class="peer sr-only" checked>
                                    <div class="p-3 rounded-xl border-2 border-slate-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-center h-full">
                                        <i class="fas fa-envelope text-lg text-slate-400 peer-checked:text-blue-600"></i>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:text-blue-700">Correo</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="preferencia_contacto" value="whatsapp" class="peer sr-only">
                                    <div class="p-3 rounded-xl border-2 border-slate-200 peer-checked:border-green-500 peer-checked:bg-green-50 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-center h-full">
                                        <i class="fab fa-whatsapp text-lg text-slate-400 peer-checked:text-green-600"></i>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:text-green-700">WhatsApp</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div id="container-inputs">
                            <div id="input-email" class="group transition-all duration-300">
                                <label for="email_contacto" class="block text-sm font-bold text-slate-700 mb-2">Tu Correo Electrónico</label>
                                <div class="relative">
                                    <i class="fas fa-at absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                    <input type="email" id="email_contacto" class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium" placeholder="ejemplo@empresa.com">
                                </div>
                            </div>

                            <div id="input-whatsapp" class="group hidden transition-all duration-300">
                                <label for="telefono" class="block text-sm font-bold text-slate-700 mb-2">Tu Número de WhatsApp</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm"><i class="fas fa-phone mr-1"></i></span>
                                    <input type="tel" id="telefono" class="w-full pl-12 pr-4 py-3.5 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-green-500 focus:ring-4 focus:ring-green-500/10 outline-none transition-all font-medium" placeholder="+58 412 0000000">
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-bold text-slate-700 mb-3">¿En qué estás interesado?</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="servicio" value="Desarrollo Web" class="peer sr-only" checked>
                                    <div class="p-3 rounded-xl border border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-center h-full">
                                        <i class="fas fa-globe text-slate-400 peer-checked:text-[#0040A8]"></i>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:text-[#0040A8]">Web</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="servicio" value="Sistemas SaaS" class="peer sr-only">
                                    <div class="p-3 rounded-xl border border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-center h-full">
                                        <i class="fas fa-database text-slate-400 peer-checked:text-[#0040A8]"></i>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:text-[#0040A8]">Sistemas</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="servicio" value="Automatización" class="peer sr-only">
                                    <div class="p-3 rounded-xl border border-slate-200 peer-checked:border-[#0040A8] peer-checked:bg-blue-50 hover:bg-slate-50 transition-all flex items-center justify-center gap-2 text-center h-full">
                                        <i class="fas fa-robot text-slate-400 peer-checked:text-[#0040A8]"></i>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:text-[#0040A8]">Bots</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="group">
                            <label for="mensaje" class="block text-sm font-bold text-slate-700 mb-2">Cuéntanos sobre tu proyecto</label>
                            <textarea id="mensaje" name="mensaje" rows="3" class="w-full p-4 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-[#0040A8] focus:ring-4 focus:ring-blue-500/10 outline-none transition-all font-medium resize-none" placeholder="Necesito una página web para..."></textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="w-full py-4 bg-[#0040A8] text-white font-bold rounded-xl hover:bg-[#003080] transition-all shadow-lg shadow-blue-900/20 transform hover:-translate-y-1 flex items-center justify-center gap-3 text-lg group">
                            <span>Enviar Información</span>
                            <i class="fas fa-arrow-right text-lg group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        
                        <div id="successMessage" class="hidden bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-center">
                            <div class="font-bold text-lg mb-1"><i class="fas fa-check-circle mr-2"></i>¡Recibido!</div>
                            <p class="text-sm">Hemos guardado tu solicitud. Te contactaremos pronto.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="toast" class="fixed bottom-8 right-8 z-50 transform translate-y-24 opacity-0 transition-all duration-500 ease-out pointer-events-none">
    <div class="bg-slate-800/90 backdrop-blur-md border-l-4 border-blue-500 text-white px-6 py-4 rounded-xl shadow-2xl shadow-blue-900/30 flex items-center gap-4 min-w-[300px]">
        <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center shrink-0">
            <i class="fas fa-check"></i>
        </div>
        <div>
            <h4 class="font-bold text-sm">¡Copiado!</h4>
            <p class="text-xs text-slate-400">Dirección de correo en portapapeles.</p>
        </div>
    </div>
</div>

<script>
// FUNCIÓN PARA EL TOAST
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('toast');
        
        // Mostrar (Animación de entrada)
        toast.classList.remove('translate-y-24', 'opacity-0');
        
        // Ocultar después de 3 segundos
        setTimeout(() => {
            toast.classList.add('translate-y-24', 'opacity-0');
        }, 3000);
        
    }).catch(err => {
        console.error('Error al copiar: ', err);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // Referencias
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const successMsg = document.getElementById('successMessage');
    
    // Switch de Preferencia
    const radios = document.querySelectorAll('input[name="preferencia_contacto"]');
    const inputWs = document.getElementById('input-whatsapp');
    const inputEm = document.getElementById('input-email');
    const fieldWs = document.getElementById('telefono');
    const fieldEm = document.getElementById('email_contacto');

    radios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if(e.target.value === 'whatsapp') {
                inputWs.classList.remove('hidden');
                inputEm.classList.add('hidden');
                setTimeout(() => fieldWs.focus(), 100);
            } else {
                inputWs.classList.add('hidden');
                inputEm.classList.remove('hidden');
                setTimeout(() => fieldEm.focus(), 100);
            }
        });
    });
    
    // Envío del Formulario
    form.addEventListener('submit', async (e) => {
        e.preventDefault(); 

        const nombre = document.getElementById('nombre').value;
        const servicio = document.querySelector('input[name="servicio"]:checked').value;
        const mensaje = document.getElementById('mensaje').value;
        const preferencia = document.querySelector('input[name="preferencia_contacto"]:checked').value;
        
        let contactoValue = '';

        if(preferencia === 'whatsapp') {
            contactoValue = fieldWs.value;
            if(!contactoValue) {
                alert('Por favor, ingresa tu número de WhatsApp.');
                fieldWs.focus();
                return;
            }
        } else {
            contactoValue = fieldEm.value;
            if(!contactoValue) {
                alert('Por favor, ingresa tu correo electrónico.');
                fieldEm.focus();
                return;
            }
        }

        if(!nombre) {
            alert('Por favor, indica tu nombre.');
            return;
        }

        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Guardando...';
        submitBtn.disabled = true;

        try {
            const response = await fetch('admin/api/save_lead.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    nombre, 
                    contacto: contactoValue + ' (' + preferencia.toUpperCase() + ')', 
                    servicio, 
                    mensaje 
                })
            });

            const result = await response.json();

            if(result.success) {
                submitBtn.classList.add('hidden');
                successMsg.classList.remove('hidden');
                form.reset();
                radios[0].click(); // Reset a Email

                setTimeout(() => {
                    successMsg.classList.add('hidden');
                    submitBtn.classList.remove('hidden');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);

            } else {
                throw new Error(result.error || 'Error desconocido');
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un error al enviar la solicitud.');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
});
</script>

<?php include 'components/footer.php'; ?>