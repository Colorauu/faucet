<?php
// DEBUG (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// bootstrap
require_once __DIR__ . '/app/core/autoload.php';

// run
$app = new App();
