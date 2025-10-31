<?php
class dbactividades {
    private static $host = "localhost";     
    private static $dbname = "db_actividades"; 
    private static $user = "root";            
    private static $pass = "";                

    public static function conectar() {
        try {
            $conexion = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                self::$user,
                self::$pass
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }
}
?>
