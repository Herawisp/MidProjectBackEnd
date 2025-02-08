<?php
require_once '../Database/Dbh.php';

class Users extends Dbh {
    protected function getUser($userId) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    protected function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function getUserEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchAll();
    }
    
    protected function setUser($first_name, $last_name, $email, $photo, $password, $bio) {
        $sql = "INSERT INTO users (first_name, last_name, email, photo, password, bio) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$first_name, $last_name, $email, $photo, $password, $bio]);
    }

    protected function delete($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);
    }

    protected function update($first_name, $last_name, $email, $photo, $bio, $id) {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, photo = ?, bio = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$first_name, $last_name, $email, $photo, $bio, $id]);
    }
}
