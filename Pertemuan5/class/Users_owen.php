<?php
require_once '../database/Dbh.php';

class Users extends Dbh {
    protected function getUser($userId) {
        $sql = "SELECT * FROM users WHERE id = ?"; // SQL Query
        $stmt = $this->connect()->prepare($sql); //Preaparing the SQL Query
        $stmt->execute([$userId]); //Executing the Query
        $results = $stmt->fetch(); //Getting the User 
        $this->close(); //Don't forget to close the Connection
        
        return $results; //Returning the User
    }
    
    protected function getUserEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?"; // SQL Query
        $stmt = $this->connect()->prepare($sql); //Preaparing the SQL Query
        $stmt->execute([$email]); //Executing the Query
        $results = $stmt->fetch(); //Getting the User 
        $this->close(); //Don't forget to close the Connection
        
        return $results; //Returning the User
    }
    
    protected function setUser($first_name, $last_name, $email, $password, $photo, $dob, $desc) {
        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `pass`, `photo`, `dob`, `description`) VALUES (?, ?, ?, ?, ?, ?, ?);"; //SQL Query
        $stmt = $this->connect()->prepare($sql); //Preaparing the SQL Query

        //Executing the Query (Make sure the order of the variabel is the same as the table in Database)
        $stmt->execute([ 
            $first_name, 
            $last_name, 
            $email, 
            $password, 
            $photo, 
            $dob, 
            $desc
        ]);

        //Don't Forget to Close the Database 
        $this->close();
    }
    
    protected function getAllUsers(){
        $sql = "SELECT * FROM users"; //Sql Query
        $stmt = $this->connect()->query($sql); //Connecting to Databse and Setting the Query;
        $results = $stmt->fetchAll(); //Fetching all of the Users in the Databse;
        $this->close(); //Don't Forget to Close the Database 
        return $results; //returning the All of the Users
    }

    protected function delete($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userId]);

        $this->close();
    }

    protected function update($first_name, $last_name, $email, $password, $photo, $dob, $desc, $id) {
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, pass = ?, photo = ?, dob = ?, description = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([ 
            $first_name, 
            $last_name, 
            $email, 
            $password, 
            $photo, 
            $dob, 
            $desc,
            $id
        ]);

        $this->close();
    }

    protected function searchUser($value) { 
        $sql = "SELECT * FROM users WHERE first_name LIKE :value OR last_name LIKE :value OR email LIKE :value";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindValue(':value', '%' . $value . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll();
    
        $this->close(); 
        return $results;
    }    
}