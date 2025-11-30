<?php
echo "<pre>";

// Intento de conexión manual sin clases
$host = "localhost";
$db = "profesores";   // <-- asegúrate que es el nombre de TU base
$user = "root";
$pass = "12345";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ CONECTADO A LA BASE DE DATOS '$db'";

} catch (PDOException $e) {
    echo "❌ ERROR DE CONEXIÓN: " . $e->getMessage();
}

echo "</pre>";
