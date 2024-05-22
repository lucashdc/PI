<?php

const DB_SERVER = 'mysql.pratico.app.br';
const DB_USERNAME = 'pratico04';
const DB_PASSWORD = 'PiUnivesp0424';
const DB_NAME = 'pratico04';

class Database {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

$database = new Database();
$conn = $database->getConnection();

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
