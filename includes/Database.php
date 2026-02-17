<?php

class Database {
    private $host = 'localhost'; // Change if needed
    private $db_name = 'your_database_name'; // Change to your database name
    private $username = 'your_username'; // Change to your database username
    private $password = 'your_password'; // Change to your database password
    private $connection;

    public function connect() {
        $this->connection = null;
        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->connection;
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function errorHandling() {
        if ($this->connection->errorInfo()[0] !== '00000') {
            echo 'Database Error: ' . implode(' ', $this->connection->errorInfo());
        }
    }
}
?>