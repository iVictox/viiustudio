<?php
// admin/solicitudes.php - Con Modal de Lectura
session_start();
if (!isset($_SESSION['admin_id'])) { header('Location: login.php'); exit; }
require 'config/db.php';

// Acción: Marcar como contactado
if (isset($_GET['check'])) {
    $stmt = $pdo->prepare("UPDATE leads SET estado = 'contactado' WHERE id = ?");
    $stmt->execute([$_GET['check']]);
    header('Location: solicitudes.php');
    exit;
}

// Acción: Eliminar lead
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM leads WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header('Location: solicitudes.php');
    exit;
}

// Obtener todos los leads
$stmt = $pdo->query("SELECT * FROM leads ORDER BY fecha DESC");
$leads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Solicitudes | Viiu Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        /* Animación para el modal */
        .modal-enter { opacity: 0; transform: scale(0.95); }
        .modal-enter-active { opacity: 1; transform: scale(1); transition: opacity 0.3s, transform 0.3s; }
        .modal-exit { opacity: 1; transform: scale(1); }
        .modal-exit-active { opacity: 0; transform: scale(0.95); transition: opacity 0.2s, transform 0.2s; }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen">
    
    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 p-8 overflow-y-auto relative">
        <header class="mb-8 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Buzón de Entrada</h1>
                <p class="text-slate-500 text-sm">Gestiona y responde a tus clientes potenciales.</p>
            </div>
        </header>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-700 uppercase font-bold text-xs border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4">Estado</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Contacto</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($leads as $lead): 
                            // Preparamos los datos para enviarlos al JS de forma segura
                            $leadData = htmlspecialchars(json_encode($lead), ENT_QUOTES, 'UTF-8');
                        ?>
                        <tr class="group hover:bg-slate-50 transition-colors <?php echo $lead['estado'] == 'nuevo' ? 'bg-blue-50/40' : ''; ?>">
                            <td class="px-6 py-4 w-32">
                                <?php if($lead['estado'] == 'nuevo'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200 uppercase tracking-wide">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span> Nuevo
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200 uppercase tracking-wide">
                                        <i class="fas fa-check text-slate-400"></i> Leído
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs whitespace-nowrap text-slate-500 w-32">
                                <div><?php echo date('d M, Y', strtotime($lead['fecha'])); ?></div>
                                <div class="text-[10px] opacity-70"><?php echo date('H:i A', strtotime($lead['fecha'])); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 text-base"><?php echo htmlspecialchars($lead['nombre']); ?></div>
                                <div class="text-xs text-slate-500 mt-0.5 flex items-center gap-1">
                                    <span class="bg-slate-100 px-1.5 py-0.5 rounded text-slate-600 font-medium">
                                        <?php echo htmlspecialchars($lead['servicio']); ?>
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                <?php echo htmlspecialchars($lead['contacto']); ?>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <button onclick="openModal(<?php echo $leadData; ?>)" class="bg-white border border-slate-200 hover:border-blue-500 hover:text-blue-600 text-slate-500 p-2 rounded-lg shadow-sm transition-all mr-2 group/btn" title="Leer Mensaje Completo">
                                    <div class="flex items-center gap-2 px-2">
                                        <i class="fas fa-eye group-hover/btn:scale-110 transition-transform"></i>
                                        <span class="text-xs font-bold">Leer</span>
                                    </div>
                                </button>

                                <?php if($lead['estado'] == 'nuevo'): ?>
                                    <a href="solicitudes.php?check=<?php echo $lead['id']; ?>" class="inline-block bg-white border border-slate-200 hover:border-green-500 hover:text-green-600 text-slate-500 p-2 rounded-lg shadow-sm transition-all mr-2" title="Marcar como atendido">
                                        <i class="fas fa-check px-1"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <a href="solicitudes.php?delete=<?php echo $lead['id']; ?>" onclick="return confirm('¿Eliminar este registro permanentemente?');" class="inline-block bg-white border border-slate-200 hover:border-red-500 hover:text-red-500 text-slate-400 p-2 rounded-lg shadow-sm transition-all" title="Eliminar">
                                    <i class="fas fa-trash px-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($leads)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center text-slate-400">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-2xl">
                                        <i class="fas fa-inbox"></i>
                                    </div>
                                    <p>No hay solicitudes recibidas aún.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div id="msgModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop"></div>
        
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform scale-95 opacity-0 transition-all duration-300" id="modalContent">
                
                <div class="bg-slate-50 px-6 py-4 rounded-t-2xl border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800" id="mNombre">Nombre Cliente</h3>
                        <p class="text-xs text-slate-500 uppercase tracking-wider font-bold" id="mServicio">Servicio</p>
                    </div>
                    <button onclick="closeModal()" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-slate-300 text-slate-500 hover:text-slate-700 flex items-center justify-center transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="p-8">
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Mensaje del Cliente</label>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-slate-700 leading-relaxed text-sm max-h-60 overflow-y-auto" id="mMensaje">
                            </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-blue-50/50 rounded-lg border border-blue-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-address-book text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 font-bold">Dato de Contacto</p>
                            <p class="text-sm font-medium text-slate-800 truncate" id="mContacto">contact@email.com</p>
                        </div>
                        <button onclick="copiarContacto()" class="text-blue-600 hover:text-blue-800 text-xs font-bold px-2 py-1 rounded hover:bg-blue-100 transition-colors">
                            Copiar
                        </button>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/50 rounded-b-2xl">
                    <button onclick="closeModal()" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors">
                        Cerrar
                    </button>
                    <a href="#" id="mWhatsappLink" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 transition-colors shadow-lg shadow-green-900/20 flex items-center gap-2">
                        <i class="fab fa-whatsapp"></i> Responder
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('msgModal');
        const backdrop = document.getElementById('modalBackdrop');
        const content = document.getElementById('modalContent');
        
        // Elementos internos
        const mNombre = document.getElementById('mNombre');
        const mServicio = document.getElementById('mServicio');
        const mMensaje = document.getElementById('mMensaje');
        const mContacto = document.getElementById('mContacto');
        const mWhatsappLink = document.getElementById('mWhatsappLink');

        function openModal(data) {
            // Llenar datos
            mNombre.textContent = data.nombre;
            mServicio.textContent = data.servicio;
            mMensaje.textContent = data.mensaje || "El cliente no dejó ningún mensaje adicional.";
            mContacto.textContent = data.contacto;

            // Configurar botón de WhatsApp
            // Intentamos limpiar el contacto para que sea un número si es posible, o usamos un link genérico si es email
            const text = `Hola ${data.nombre}, he recibido tu solicitud sobre ${data.servicio} en Viiu Studio.`;
            const isEmail = data.contacto.includes('@');
            
            if(isEmail) {
                 mWhatsappLink.href = `mailto:${data.contacto}?subject=Respuesta Viiu Studio&body=${text}`;
                 mWhatsappLink.innerHTML = '<i class="fas fa-envelope"></i> Responder Email';
                 mWhatsappLink.className = "px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-900/20 flex items-center gap-2";
            } else {
                // Asumimos que es número
                // Limpiamos todo lo que no sea número para el link
                let number = data.contacto.replace(/\D/g,'');
                mWhatsappLink.href = `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
                mWhatsappLink.innerHTML = '<i class="fab fa-whatsapp"></i> Responder WhatsApp';
                mWhatsappLink.className = "px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 transition-colors shadow-lg shadow-green-900/20 flex items-center gap-2";
            }

            // Mostrar Modal con Animación
            modal.classList.remove('hidden');
            // Timeout pequeño para permitir que el navegador renderice antes de cambiar opacidad (para transición)
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                content.classList.remove('scale-95', 'opacity-0');
            }, 10);
        }

        function closeModal() {
            backdrop.classList.add('opacity-0');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Esperar que termine la transición
        }

        function copiarContacto() {
            const text = mContacto.textContent;
            navigator.clipboard.writeText(text).then(() => {
                alert('Copiado: ' + text);
            });
        }

        // Cerrar al clickear fuera
        backdrop.addEventListener('click', closeModal);
    </script>
</body>
</html>