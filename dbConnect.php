<?php

$host = 'localhost';
$db = 'arcadia_db';
$user = 'root';
$pass = '';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Erreur de connexion'. mysqli_connect_error());
}

