<?php

class User {
    private $db;

    public function __construct($db = null) {
        $this->db = $db;
    }

    public function createUser($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // Save to database
        return true;
    }

    public function getUserByEmail($email) {
        // Retrieve from database
        return null;
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function getAllUsers() {
        // Retrieve all users from database
        return [];
    }

    public function deleteUser($id) {
        // Delete user from database
        return true;
    }

    public function updateUser($id, $data) {
        // Update user in database
        return true;
    }
}
?>