<?php
// data/info-general.php

$info = [
    'nombre' => 'Viiu Studio',
    'slogan' => 'Tu Departamento de Tecnología',
    'descripcion' => 'Agencia de desarrollo y automatización. Ofrecemos soluciones tecnológicas por suscripción: desde páginas web y sistemas administrativos hasta la automatización de tus flujos de trabajo.',
    'telefono' => '+58 412 77 03302', 
    'email' => 'contacto@viiu.studio',
    'direccion' => 'Valencia, Carabobo, Venezuela',
    'whatsapp_link' => 'https://wa.link/qqpvld',
    'instagram' => '@viiustudio',
    'linkedin' => 'viiu-studio',
    'color_primary' => '#0040A8'
];

// ESTRUCTURA SEPARADA POR CATEGORÍAS
$categorias_planes = [
    'web' => [
        'titulo_seccion' => 'Desarrollo & Presencia Web',
        'descripcion_seccion' => 'Para negocios que necesitan visibilidad, posicionamiento y una imagen profesional impecable.',
        'planes' => [
            [
                'titulo' => 'Landing Page',
                'precio' => '45',
                'features' => ['Diseño de Alta Conversión', 'Hosting y Dominio Incluido', 'Certificado SSL', 'Integración WhatsApp', 'Mantenimiento Mensual'],
                'destacado' => false
            ],
            [
                'titulo' => 'Web Corporativa',
                'precio' => '75',
                'features' => ['Hasta 6 Secciones', 'Blog Autoadministrable', 'Optimización SEO', 'Correos Corporativos', 'Soporte Prioritario'],
                'destacado' => true
            ],
            [
                'titulo' => 'E-Commerce',
                'precio' => '120',
                'features' => ['Tienda Online Completa', 'Pasarelas de Pago', 'Gestión de Productos', 'Panel de Ventas', 'Seguridad Avanzada'],
                'destacado' => false
            ]
        ]
    ],
    'sistemas' => [
        'titulo_seccion' => 'Sistemas Administrativos (SaaS)',
        'descripcion_seccion' => 'Software a medida para gestionar tu empresa. Deja el Excel y pásate a la nube.',
        'planes' => [
            [
                'titulo' => 'Gestión Básica',
                'precio' => '150',
                'features' => ['Control de Inventario o Citas', 'Base de Datos Clientes', '1 Usuario Administrador', 'Reportes Básicos', 'Backups Diarios'],
                'destacado' => false
            ],
            [
                'titulo' => 'Sistema ERP / CRM',
                'precio' => '280',
                'features' => ['Múltiples Módulos a Medida', 'Roles de Usuarios (Admin/Empleado)', 'Facturación PDF', 'Dashboard Financiero', 'API Rest'],
                'destacado' => true
            ]
        ]
    ],
    'automatizacion' => [
        'titulo_seccion' => 'Automatización de Procesos',
        'descripcion_seccion' => 'Conectamos tus aplicaciones para que trabajen solas. Ahorra tiempo y elimina errores humanos.',
        'planes' => [
            [
                'titulo' => 'Bot de Atención',
                'precio' => '80',
                'features' => ['Auto-respuestas WhatsApp/IG', 'Menú de Opciones', 'Captura de Leads', 'Envío de Catálogos PDF', 'Horario 24/7'],
                'destacado' => false
            ],
            [
                'titulo' => 'Flujos de Negocio',
                'precio' => '160',
                'features' => ['Integración CRM + Email + Sheets', 'Notificaciones de Ventas', 'Automatización de Facturas', 'Alertas de Stock', 'Soporte Técnico Especializado'],
                'destacado' => true
            ]
        ]
    ]
];

// Datos visuales para ejemplos de automatización (sin mencionar N8N/Tecnicismos)
$ejemplos_auto = [
    [
        'titulo' => 'Ventas Automáticas',
        'icono' => 'fa-robot',
        'texto' => 'El cliente pregunta precio en Instagram > El bot responde y envía catálogo > Cliente compra > Se registra la venta en Excel y se avisa al almacén.'
    ],
    [
        'titulo' => 'Gestión de Citas',
        'icono' => 'fa-calendar-check',
        'texto' => 'Cliente agenda en la web > Se bloquea el espacio en Google Calendar > Se envía confirmación por WhatsApp y recordatorio 1 hora antes.'
    ]
];
?>