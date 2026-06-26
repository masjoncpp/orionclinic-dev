<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
require_once __DIR__ . '/../app/Config/Paths.php';
$paths = new Config\Paths();
require rtrim($paths->systemDirectory, '\\/ ') . '/bootstrap.php';
$db = \Config\Database::connect();
$db->table('doctors')->update(['status' => 'offline']);
echo "All offline.";
