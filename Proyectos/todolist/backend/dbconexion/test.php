<?php
class Conexion {
    public static function conectar() {
        $host = "localhost";
        $usuario = "root";
        $contraseña = "";
        $bd = "db_actividades";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$bd;charset=utf8", $usuario, $contraseña);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }
}
?>
