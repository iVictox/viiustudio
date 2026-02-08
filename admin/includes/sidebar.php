<aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col h-screen sticky top-0">
    <div class="p-6 border-b border-slate-800">
        <h2 class="text-2xl font-bold text-white tracking-wider">Viiu<span class="text-blue-500">Panel</span></h2>
    </div>
    <nav class="flex-1 py-6 space-y-1">
        <?php
        $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        function isActive($name, $cur) {
            return $name === $cur ? 'bg-blue-700 text-white border-r-4 border-blue-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white';
        }
        ?>
        <a href="index.php" class="flex items-center gap-3 py-3 px-6 transition-colors <?php echo isActive('index.php', $curPageName); ?>">
            <i class="fas fa-home w-5 text-center"></i> Dashboard
        </a>
        <a href="solicitudes.php" class="flex items-center gap-3 py-3 px-6 transition-colors <?php echo isActive('solicitudes.php', $curPageName); ?>">
            <i class="fas fa-envelope w-5 text-center"></i> Solicitudes
        </a>
        <a href="planes.php" class="flex items-center gap-3 py-3 px-6 transition-colors <?php echo isActive('planes.php', $curPageName); ?>">
            <i class="fas fa-tags w-5 text-center"></i> Planes & Precios
        </a>
        <a href="portafolio.php" class="flex items-center gap-3 py-3 px-6 transition-colors <?php echo isActive('portafolio.php', $curPageName); ?>">
            <i class="fas fa-briefcase w-5 text-center"></i> Portafolio
        </a>
    </nav>
    <div class="p-4 border-t border-slate-800">
        <a href="logout.php" class="flex items-center gap-3 py-2 px-4 text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </div>
</aside>