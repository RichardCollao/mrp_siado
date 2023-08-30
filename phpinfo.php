<?php

// Muestra toda la información, por defecto INFO_ALL
phpinfo();

// Muestra solamente la información de los módulos.
// phpinfo(8) hace exactamente lo mismo.
phpinfo(INFO_MODULES);

echo '<pre>';
print_r(apache_get_modules());
echo '</pre>';
?>