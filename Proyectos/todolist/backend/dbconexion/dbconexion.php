<?PHP
class db_actividades{
    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db = "db_actividades";
    private static $port = "3307";
    private static $conn;
    public static function conectar(){
    
        try{
            $conn = new PDO("mysql:host=".self::$host.";port=".self::$port.";dbname=".self::$db,self::$user,self::$pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch(PDOException $e){
            echo "Error de conexión: " . $e->getMessage();

            }
    }
}   