<?php
class dbconexion {
    public static function conectar() {
        try {
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "dbactividades";

            $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
?>
