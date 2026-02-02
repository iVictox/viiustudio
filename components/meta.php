<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . $info['nombre'] : $info['nombre']; ?></title>
<meta name="description" content="<?php echo $info['descripcion']; ?>">

<script src="https://cdn.tailwindcss.com"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    viiu: {
                        50: '#eef6ff',
                        100: '#dbeafe',
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#0040A8', /* Tu color principal */
                        800: '#002d7a',
                        900: '#1e3a8a',
                    }
                },
                fontFamily: {
                    sans: ['Outfit', 'sans-serif'],
                }
            }
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">