<?php
// data/info-general.php

$info = [
    'nombre' => 'Viiu Studio',
    'slogan' => 'Tu socio tecnológico de confianza',
    'descripcion' => 'Agencia de desarrollo de software enfocada en soluciones reales. Creamos sistemas, páginas web y aplicaciones a medida bajo un modelo de suscripción accesible.',
    'telefono' => '+58 412 77 03302', // Actualiza con tu número real
    'email' => 'contacto@viiu.studio',
    'direccion' => 'Valencia, Carabobo, Venezuela',
    'whatsapp_link' => 'wa.link/qqpvld', // Link directo
    'instagram' => '@viiustudio',
    'linkedin' => 'viiu-studio',
    'color_primary' => '#0040A8'
];

// Definición de Servicios / Planes de Suscripción
$planes = [
    'basico' => [
        'titulo' => 'Presencia Digital',
        'subtitulo' => 'Ideal para profesionales y emprendedores',
        'precio' => '49', 
        'features' => [
            'Landing Page de Alto Impacto',
            'Hosting y Dominio Incluido',
            'Certificado SSL (Seguridad)',
            'Botón de WhatsApp Flotante',
            'Soporte Técnico Básico',
            'Actualizaciones de texto/imagen mensuales'
        ],
        'recomendado' => false
    ],
    'estandar' => [
        'titulo' => 'Negocio Dinámico',
        'subtitulo' => 'Para pymes que necesitan gestionar contenido',
        'precio' => '99', 
        'features' => [
            'Sitio Web Multi-página (Hasta 5)',
            'Panel Autoadministrable',
            'Blog o Sección de Noticias',
            'Integración con Redes Sociales',
            'Optimización SEO Básica',
            'Correo Corporativo Incluido',
            'Prioridad de desarrollo',
            'Mantenimiento Mensual Prioritario'
        ],
        'recomendado' => true 
    ],
    'pro' => [
        'titulo' => 'Sistemas a Medida',
        'subtitulo' => 'Automatización y Gestión Empresarial',
        'precio' => 'Consultar',
        'features' => [
            'Desarrollo de Software a Medida (SaaS)',
            'Sistemas de Gestión (CRUD, Dashboards)',
            'Base de Datos PostgreSQL/MySQL',
            'API RESTful',
            'Tiendas Online (E-commerce)',
            'Soporte 24/7',
            'Prioridad de desarrollo',
            'Infraestructura Escalable'
        ],
        'recomendado' => false
    ]
];
?>