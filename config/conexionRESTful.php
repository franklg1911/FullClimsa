<?php
class Conexion {
    private $servername = "localhost";
    private $username = "u2uhzjl9vvbeejwu";
    private $password = "1ynHEVRW6BsH70EoNSRZ";
    private $dbname = "brc9cbwy6gdnfx0ibqhn";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexión fallida: " . $e->getMessage();
        }
    }

    public function obtenerConexion() {
        return $this->conn;
    }
}
?>
