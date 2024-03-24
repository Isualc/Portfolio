<?php 
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "onlineshop";
    const ADMIN = 7;
    public $con;

    public function getConnection() {
        // Setzt die Verbindungsvariable auf null, um sicherzustellen, dass sie anfangs leer ist.
        $this->con = null;
    
        try {
            // Erstellt den Data Source Name (DSN), der die Informationen zum Verbinden mit der Datenbank enthält.
            // Hier wird der MySQL-Host und der Datenbankname verwendet, die als Eigenschaften des Objekts gespeichert sind.
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db;
    
            // Erstellt ein neues PDO-Objekt für die Datenbankverbindung mit dem DSN und den Benutzerdaten.
            // PDO steht für PHP Data Objects und ist eine Abstraktionsschicht für den Datenbankzugriff.
            $this->con = new PDO($dsn, $this->username, $this->password);
    
            // Setzt die Kodierung auf UTF-8, um sicherzustellen, dass alle Daten korrekt dargestellt werden.
            $this->con->exec("set names utf8");
    
            // Setzt den Fehlermodus auf 'PDO::ERRMODE_EXCEPTION', damit Fehler als Exceptions geworfen werden.
            // Dies ist nützlich für das Fehler-Handling und die Fehlerüberwachung.
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Im Falle eines Fehlers beim Verbindungsaufbau wird dieser Block ausgeführt.
            // Hier wird der Fehler geloggt anstatt ihn direkt auszugeben.
            // 'error_log()' ist eine PHP-Funktion, die Fehler in den Server-Log schreibt.
            error_log("Database connection error: " . $exception->getMessage());
        }
    
        // Gibt die Datenbankverbindung zurück, entweder als PDO-Objekt oder als null, wenn die Verbindung fehlschlug.
        return $this->con;
    }
}   
?>
