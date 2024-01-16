<?php
$bdd;
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=base;charset=utf8', 'root', 'Ilyas.99', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur:' . $e->getMessage());
}
