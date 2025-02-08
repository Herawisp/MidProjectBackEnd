<?php
require_once '../Database/Dbh.php';

class Users extends Dbh {
    protected function getUser($userId) {
        $sql = "SELECT * FROM users WHERE id = ?"; // SQL Query
        $stmt = $this->connect()->prepare($sql); //Preaparing the SQL Query
        $stmt->execute([$userId]); //Executing the Query
        $results = $stmt->fetch(); //Getting the User 
        $this->close(); //Don't forget to close the Connection
        
        return $results; //Returning the User
    }

    protected function getAllUsers() {
       $sql = "SELECT * FROM users"; 
       $stmt = $this->connect()->query($sql); //Statment
       $results = $stmt->fetchAll();
       $this->close();
       return $results;
    }

    protected function getUserEmail($email){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $results = $stmt->fetch();
        $this->close();

        return $results;

    }
    
    protected function setUser($first_name, $last_name, $email, $photo, $bio) {
        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `photo`, `bio`) 
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->connect()->prepare($sql); 
        $stmt->execute([
            $first_name,
            $last_name,
            $email,
            $photo,
            $bio
        ]);

        $this->close();
    }


    protected function delete($userId){
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $userId]);
        
        $this->close();
    }

    protected function update( $first_name, $last_name, $email, $photo, $bio, $id){
        $sql = "UPDATE users set first_name = ?, last_name = ?
        ,email = ?, photo = ?, bio = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $first_name,
            $last_name,
            $email,
            $photo,
            $bio,
            $id
        ]);

        $this->close();
    }

}