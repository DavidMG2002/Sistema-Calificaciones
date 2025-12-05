<?php
class Database {
    private $host = "localhost";
    private $port = "3307";  // <-- CAMBIA ESTE AL PUERTO REAL DE TU XAMPP
    private $db_name = "profesores";
    private $username = "root";
    private $password = "maringallego18";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8";

            $this->conn = new PDO(
                $dsn,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
