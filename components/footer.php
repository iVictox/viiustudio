</main> <footer class="bg-white border-t border-gray-200 pt-16 pb-8">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="/viiu-studio/assets/img/logo.svg" style="max-width: 200px;">
                    </div>
                    <p class="text-gray-500 mb-4 max-w-sm">
                        <?php echo $info['descripcion']; ?>
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-[#0040A8] hover:bg-[#0040A8] hover:text-white transition-all"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-[#0040A8] hover:bg-[#0040A8] hover:text-white transition-all"><i class="fab fa-linkedin-in"></i></a>
                        <a href="<?php echo $info['whatsapp_link']; ?>" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-[#0040A8] hover:bg-[#0040A8] hover:text-white transition-all"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-4">Empresa</h3>
                    <ul class="space-y-2 text-gray-500">
                        <li><a href="nosotros.php" class="hover:text-[#0040A8] transition-colors">Sobre Nosotros</a></li>
                        <li><a href="servicios.php" class="hover:text-[#0040A8] transition-colors">Nuestros Planes</a></li>
                        <li><a href="portafolio.php" class="hover:text-[#0040A8] transition-colors">Proyectos</a></li>
                        <li><a href="contacto.php" class="hover:text-[#0040A8] transition-colors">Trabaja con nosotros</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-gray-900 mb-4">Contacto</h3>
                    <ul class="space-y-2 text-gray-500">
                        <li class="flex items-center"><i class="fas fa-map-marker-alt w-5 text-[#0040A8]"></i> <?php echo $info['direccion']; ?></li>
                        <li class="flex items-center"><i class="fas fa-envelope w-5 text-[#0040A8]"></i> <?php echo $info['email']; ?></li>
                        <li class="flex items-center"><i class="fab fa-whatsapp w-5 text-[#0040A8]"></i> <?php echo $info['telefono']; ?></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> Viiu Studio. Todos los derechos reservados.</p>
                <div class="mt-4 md:mt-0">
                    <a href="#" class="hover:text-[#0040A8] mr-4">Privacidad</a>
                    <a href="#" class="hover:text-[#0040A8]">Términos</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Inicializar animaciones
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
        });
    </script>
</body>
</html>