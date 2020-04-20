<?php

require_once 'vendor/autoload.php';

use App\Database\Database;

$database = new Database;
$pdo = $database->getPDO();

function tableExists(PDO $pdo, string $table): bool
{
    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
    } catch (\Exception $e) {
        return FALSE;
    }
    return $result !== FALSE;
}

if (tableExists($pdo, 'users')) {
    echo '<h1>Tabela users juz istnieje</h1>';
} else {
    $query = $pdo->prepare("CREATE TABLE `users` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `nick` varchar(12) COLLATE utf8_polish_ci NOT NULL,
     `email` varchar(100) COLLATE utf8_polish_ci NOT NULL,
     `city` varchar(30) COLLATE utf8_polish_ci NOT NULL,
     `postal_code` varchar(6) COLLATE utf8_polish_ci NOT NULL,
     `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci
    ");
    $query->execute();

    echo '<h1>Tabela users zostala utworzona</h1>';
}
