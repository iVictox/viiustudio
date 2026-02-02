<?php
// Obtener el nombre del archivo actual (ej: index.php)
$current_page = basename($_SERVER['PHP_SELF']);

// Función para aplicar clases de "activo" o "inactivo"
function nav_classes($page_name, $current_page) {
    $base_classes = "block py-2 px-3 rounded md:p-0 transition-colors ";
    if ($page_name === $current_page) {
        // Clases para el link ACTIVO
        return $base_classes . "text-white bg-[#0040A8] md:bg-transparent md:text-[#0040A8] font-bold";
    } else {
        // Clases para el link INACTIVO
        return $base_classes . "text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#0040A8]";
    }
}
?>

<nav class="fixed w-full z-50 top-0 start-0 border-b border-gray-200/20 bg-white/90 backdrop-blur-md transition-all duration-300" id="mainNavbar">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse group">
      <img src="/viiu-studio/assets/img/logo.svg" style="max-width: 230px;">
    </a>

    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
        <a href="<?php echo $info['whatsapp_link']; ?>" target="_blank" class="text-white bg-[#0040A8] hover:bg-[#003080] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center hidden md:block transition-colors shadow-md hover:shadow-xl">
            <i class="fab fa-whatsapp mr-2"></i> Cotizar Ahora
        </a>
        <button id="mobile-menu-btn" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    </div>

    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
        <li>
          <a href="index.php" class="<?php echo nav_classes('index.php', $current_page); ?>">Inicio</a>
        </li>
        <li>
          <a href="servicios.php" class="<?php echo nav_classes('servicios.php', $current_page); ?>">Servicios</a>
        </li>
        <li>
          <a href="portafolio.php" class="<?php echo nav_classes('portafolio.php', $current_page); ?>">Portafolio</a>
        </li>
        <li>
          <a href="contacto.php" class="<?php echo nav_classes('contacto.php', $current_page); ?>">Contacto</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="h-20"></div>