<?php
require "test.php";

$conexion = Conexion::conectar();

if ($conexion) {
    echo "✅ Conexión exitosa a la base de datos";
}
?>
