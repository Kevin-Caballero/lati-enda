<?php

class DConnection {
    private static $instance = null;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ce1pra";
    private $mysqli;

    private function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->mysqli->connect_error) {
            die("Error de conexión: " . $this->mysqli->connect_error);
        } else {
            echo '<script>console.log("Conexión exitosa a la base de datos.");</script>';
        }
    }

    public static function getInstance($host = "localhost", $username = "root", $password = "", $database = "ce1pra") {
        if (self::$instance == null) {
            self::$instance = new DConnection($host, $username, $password, $database);
        }
        return self::$instance;
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function close() {
        $this->mysqli->close();
    }
}
