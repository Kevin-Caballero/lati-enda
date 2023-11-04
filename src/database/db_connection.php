<?php

class DbConnection {
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
            self::$instance = new DbConnection($host, $username, $password, $database);
        }
        return self::$instance;
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        if ($this->mysqli->query($sql)) {
            return $this->mysqli->insert_id;
        } else {
            return false;
        }
    }

    public function update($table, $data, $condition) {
        $set = [];
        foreach ($data as $column => $value) {
            $set[] = "$column = '$value'";
        }
        $set = implode(", ", $set);
        $sql = "UPDATE $table SET $set WHERE $condition";
        return $this->query($sql);
    }

    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        return $this->query($sql);
    }

    public function close() {
        $this->mysqli->close();
    }
}
