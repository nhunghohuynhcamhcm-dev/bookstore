<?php

define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);

require_once ROOTDIR . 'vendor/autoload.php';
require_once ROOTDIR . 'app/functions.php';

// Load .env file if it exists
if (file_exists(ROOTDIR . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOTDIR);
    $dotenv->load();
} else {
    // Set default values for XAMPP
    $_ENV['DB_HOST'] = 'localhost';
    $_ENV['DB_NAME'] = 'bookstore';
    $_ENV['DB_USER'] = 'root';
    $_ENV['DB_PASS'] = '';
}

use Illuminate\Database\Capsule\Manager;

$manager = new Manager();

$manager->addConnection([
	'driver'    => 'mysql',
	'host'      => $_ENV['DB_HOST'],
	'database'  => $_ENV['DB_NAME'],
	'username'  => $_ENV['DB_USER'],
	'password'  => $_ENV['DB_PASS'],
]);

$manager->setAsGlobal();
$manager->bootEloquent();
