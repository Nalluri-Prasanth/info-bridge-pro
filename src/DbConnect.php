<?php
class DbConnect {
    private $host = 'db'; // Hostname aligns with the MySQL service name
    private $dbName = 'company';
    private $user = 'root';
    private $pass = 'password';
    

    public function connect() {
        try {
            $conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo 'Database Error: ' . $e->getMessage();
        }
    }
}
?>
