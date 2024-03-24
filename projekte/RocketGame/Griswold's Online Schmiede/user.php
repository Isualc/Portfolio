<?php 

class User extends Database {
    public $con;          // Datenbankverbindung
    private $table_name = "users";  // Name der Datenbanktabelle
    private $role;         // Benutzerrolle

    // Eigenschaften des Benutzers, $uuid ist privat, $username und $password sind öffentlich
    private $uuid;         // Eindeutige Benutzer-ID
    public $username;      // Benutzername
    public $password;      // Passwort
    private $birthday;
    private $email;
    private $address;
    private $plz;

    // Konstruktor der Klasse, wird bei der Erstellung eines User-Objekts aufgerufen
    public function __construct($db) {
        $this->con = $db;  // Setzt die Datenbankverbindung
    }

    // Setter-Methode für die UUID
    public function setUuid($uuid) {
        $this->uuid = $uuid;
    }

    // Getter-Methode für die UUID
    public function getUuid() {
        return $this->uuid;
    }

// Methode in Ihrer User-Klasse, um eine eindeutige ID zu generieren und zuzuweisen
public function generateUuid() {
    $this->uuid = uniqid();
}

    // Setter-Methode für das Passwort
    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter-Methode für die Benutzerrolle
    public function getRole() {
        return $this->role;
    }

    // Methode für die Benutzeranmeldung
    public function login() {
        // Vorbereiten des SQL-Statements zur Überprüfung des Benutzernamens
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->con->prepare($query);
        // Bindet den Benutzernamen an das SQL-Statement
        $stmt->bindParam(':username', $this->username);

        try {
            // Führt das SQL-Statement aus
            $stmt->execute();
            // Holt die Daten des Benutzers aus der Datenbank
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Überprüft, ob ein Benutzer gefunden wurde und ob das Passwort korrekt ist
            if ($row && password_verify($this->password, $row['password'])) {
                // Setzt die UUID und die Rolle aus den Datenbankdaten
                $this->setUuid($row['uuid']);
                $this->role = $row['role']; 
                // Gibt 'true' zurück, wenn die Anmeldung erfolgreich war
                return true;
            } else {
                // Gibt 'false' zurück, wenn die Anmeldung fehlschlägt
                return false;
            }
        } catch (PDOException $exception) {
            // Fehlerbehandlung für Datenbankfehler
            error_log("Login error: " . $exception->getMessage());
            // Gibt 'false' zurück, wenn ein Fehler auftritt
            return false;
        }
    }
    public function setName($username) {
        $this->username = $username;
    }

    public function setBirthday($birthday) {
        $this->birthday = date("Y-m-d", strtotime($birthday));
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPostalCode($plz) {
        $this->plz = $plz;
    }
    // Methode zur Registrierung eines neuen Benutzers
    public function register() {
        // SQL-Statement zum Einfügen des neuen Benutzers in die Datenbank
        $query = "INSERT INTO " . $this->table_name . " (uuid, username, birthday, email, address, plz, password)
          VALUES (:uuid, :username, :birthday, :email, :address, :plz, :password)";

        $stmt = $this->con->prepare($query);

        // Bindet die Werte an das SQL-Statement und führt es aus
        $stmt->bindParam(':uuid', $this->uuid);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':birthday', $this->birthday);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':plz', $this->plz);

        // Passwort sicher hashen, bevor es gespeichert wird
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        // Führt das SQL-Statement aus und überprüft, ob es erfolgreich war
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteUser($uuid) {
        try {
            $sql = "DELETE FROM users WHERE uuid = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->execute([$uuid]);
            if ($stmt->rowCount() > 0) {
                return true; // Erfolgreich gelöscht
            } else {
                return false; // Fehler beim Löschen oder Benutzer nicht gefunden
            }
        } catch (PDOException $e) {
            error_log("Löschfehler: " . $e->getMessage());
            return false;
        }
    }
    
    public function fetchUserDetails($uuid) {
        $sql = "SELECT * FROM users WHERE uuid = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([$uuid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($username, $birthday, $password, $address, $plz, $email, $role, $uuid) {
        if ($password !== null) {
            // Passwort hashen, falls es geändert wird
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET username = ?, birthday = ?, password = ?, address = ?, plz = ?, email = ?, role = ? WHERE uuid = ?";
            $update_stmt = $this->con->prepare($update_sql);
            $update_stmt->execute([$username, $birthday, $hashedPassword, $address, $plz, $email, $role, $uuid]);
        } else {
            // Passwort nicht ändern
            $update_sql = "UPDATE users SET username = ?, birthday = ?, address = ?, plz = ?, email = ?, role = ? WHERE uuid = ?";
            $update_stmt = $this->con->prepare($update_sql);
            $update_stmt->execute([$username, $birthday, $address, $plz, $email, $role, $uuid]);
        }
    
        return $update_stmt->rowCount() > 0;
    }
}
?>
