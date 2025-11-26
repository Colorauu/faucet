<?php
spl_autoload_register(function($class) {
    $base = __DIR__ . '/../';
    $paths = [
        $base . 'core/' . $class . '.php',
        $base . 'controllers/' . $class . '.php',
        $base . 'models/' . $class . '.php',
    ];
    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    // don't die here in production: helpful for debugging
    // die("Autoloader error: classe '$class' não encontrada. Procurado em: " . implode(", ", $paths));
});
