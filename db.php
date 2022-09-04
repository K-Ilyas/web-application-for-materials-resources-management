<?php
$bdd;
try {
    $bdd = new PDO('mysql:host=<host-name>;dbname=<db-name>;charset=utf8', '<user-name', '<user-password>', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur:' . $e->getMessage());
}
