<div id="viiu-chatbot" class="fixed bottom-6 right-6 z-50 flex flex-col items-end font-sans">
    
    <div id="chat-window" class="hidden bg-white w-[350px] h-[500px] rounded-2xl shadow-2xl border border-slate-200 flex flex-col overflow-hidden mb-4 transition-all duration-300 transform scale-95 opacity-0 origin-bottom-right">
        
        <div class="bg-[#0040A8] p-4 flex items-center justify-between text-white shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center relative">
                    <i class="fas fa-robot text-lg"></i>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-[#0040A8] rounded-full"></span>
                </div>
                <div>
                    <h3 class="font-bold text-sm">Viiu Assistant</h3>
                    <p class="text-[10px] text-blue-200 flex items-center gap-1">
                        <span class="animate-pulse w-1.5 h-1.5 bg-green-400 rounded-full"></span> En línea
                    </p>
                </div>
            </div>
            <button onclick="toggleChat()" class="text-white/80 hover:text-white hover:bg-white/10 p-2 rounded-full transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-50 text-sm scroll-smooth">
            <div class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-[#0040A8] flex items-center justify-center shrink-0">
                    <i class="fas fa-robot text-xs"></i>
                </div>
                <div class="bg-white p-3 rounded-tr-xl rounded-br-xl rounded-bl-xl shadow-sm border border-slate-100 text-slate-700">
                    <p>¡Hola! 👋 Soy la IA de Viiu Studio.</p>
                    <p class="mt-1">Puedo ayudarte con precios, planes o dudas técnicas. ¿Qué necesitas saber?</p>
                </div>
            </div>
        </div>

        <div class="p-3 bg-white border-t border-slate-100">
            <form id="chat-form" class="flex gap-2 items-end">
                <input type="text" id="user-input" placeholder="Pregunta sobre precios..." class="w-full bg-slate-100 border-0 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#0040A8] outline-none text-slate-700" autocomplete="off">
                <button type="submit" class="bg-[#0040A8] hover:bg-blue-700 text-white p-3 rounded-xl transition-colors shadow-lg shadow-blue-900/20">
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </form>
            <div class="text-center mt-2">
                 <p class="text-[10px] text-slate-400">Powered by Viiu AI</p>
            </div>
        </div>
    </div>

    <button onclick="toggleChat()" id="chat-btn" class="group flex items-center justify-center w-14 h-14 bg-[#0040A8] text-white rounded-full shadow-lg shadow-blue-900/30 hover:scale-110 transition-all duration-300 relative overflow-hidden">
        <div class="absolute inset-0 bg-white/20 rounded-full animate-ping opacity-75 group-hover:opacity-0"></div>
        <i class="fas fa-comment-dots text-2xl relative z-10 transition-transform group-hover:rotate-12"></i>
    </button>
</div>

<script>
    const chatWindow = document.getElementById('chat-window');
    const messagesDiv = document.getElementById('chat-messages');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');

    function toggleChat() {
        chatWindow.classList.toggle('hidden');
        
        // Pequeño timeout para la animación de entrada
        if (!chatWindow.classList.contains('hidden')) {
            setTimeout(() => {
                chatWindow.classList.remove('scale-95', 'opacity-0');
                userInput.focus();
            }, 10);
        } else {
            chatWindow.classList.add('scale-95', 'opacity-0');
        }
    }

    function addMessage(text, sender) {
        const div = document.createElement('div');
        const isUser = sender === 'user';
        
        div.className = `flex items-start gap-2.5 ${isUser ? 'flex-row-reverse' : ''}`;
        
        const avatar = isUser 
            ? `<div class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center shrink-0"><i class="fas fa-user text-xs"></i></div>`
            : `<div class="w-8 h-8 rounded-full bg-blue-100 text-[#0040A8] flex items-center justify-center shrink-0"><i class="fas fa-robot text-xs"></i></div>`;

        const bubble = `
            <div class="${isUser ? 'bg-[#0040A8] text-white' : 'bg-white text-slate-700 border border-slate-100'} p-3 rounded-xl shadow-sm max-w-[80%] text-sm leading-relaxed">
                ${text.replace(/\n/g, '<br>')}
            </div>
        `;

        div.innerHTML = avatar + bubble;
        messagesDiv.appendChild(div);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function showTyping() {
        const id = 'typing-indicator';
        const div = document.createElement('div');
        div.id = id;
        div.className = 'flex items-start gap-2.5';
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#0040A8] flex items-center justify-center shrink-0"><i class="fas fa-robot text-xs"></i></div>
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex gap-1 items-center h-10">
                <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></div>
                <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce delay-100"></div>
                <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce delay-200"></div>
            </div>
        `;
        messagesDiv.appendChild(div);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function removeTyping() {
        const el = document.getElementById('typing-indicator');
        if(el) el.remove();
    }

    chatForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = userInput.value.trim();
        if(!text) return;

        // 1. Mostrar mensaje usuario
        addMessage(text, 'user');
        userInput.value = '';
        
        // 2. Mostrar "Escribiendo..."
        showTyping();

        try {
            // 3. Llamar al backend
            const response = await fetch('admin/api/chat.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ message: text })
            });
            const data = await response.json();
            
            // 4. Mostrar respuesta IA
            removeTyping();
            addMessage(data.reply, 'bot');

        } catch (error) {
            removeTyping();
            addMessage("Ups, tuve un problema de conexión. ¿Puedes intentar de nuevo?", 'bot');
        }
    });
</script>