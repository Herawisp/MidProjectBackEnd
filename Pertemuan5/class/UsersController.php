<?php
require 'Users.php';

class UsersController extends Users{
    private $first_name;
    private $last_name;
    private $email;
    private $photo;
    private $bio;

    private function user($data){
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->photo = $data['photo'] ?? null;
        $this->bio = $data['bio'];
    }
    public function showUsers() {
        $results = $this->getAllUsers();
        return $results;
    }

    public function createUser($data, $img) {
        $this->user($data);
        $this->validateInput(false);
        move_uploaded_file($img['tmp_name'], '../img/' . $img['name']);
        $this->setUser(
            $this->first_name, 
            $this->last_name, 
            $this->email, 
            $img['name'],
            $this->bio);
    }

    public function getOneUser($id) {
        $result = $this->getUser($id);
        return $result;
    }

    private function validateInput($checkDuplicateEmail = true) {
        if ($this->isNotEmptyInput() === false) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=emptyinput" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        if ($this->isEmail() === false) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=email" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        if ($checkDuplicateEmail && $this->duplicateEmail() === true) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=dupemail" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        return true;
    }

    private function duplicateEmail() {
        $duplicates = $this->getUserEmail($this->email);
        if (count($duplicates) > 0) {
            $result = true;
        }
        else {
            $result = true;
        }

        return $result;
    }

    private function isNotEmptyInput(){
        $result = true;
        if(empty($this->first_name) === true ||
         empty($this->last_name) === true ||
          empty($this->email) === true ||
          empty($this->bio) === true ){
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    private function isEmail(){
        $result = true;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL) === false){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function showError($error) {
        switch ($error) {
            case 'emptyinput':
                echo '<script>alert("Please fill in all required fields.");</script>';
                break;
            case 'dupemail':
                echo '<script>alert("Duplicate email address.");</script>';
                break;
            case 'email':
                echo '<script>alert("Invalid email address.");</script>';
                break;
            default:
                echo '<script>alert("An unknown error occurred.");</script>';
        }
    }

    public function updateUser($data, $img){
        $old_data = $this->getUser($data['id']);
        $data['photo'] = $old_data['photo'];
        if (isset($img) && isset($img['tmp_name']) && !empty($img['tmp_name'])) {
            $photoPath = realpath('../img/' . $old_data['photo']);
            
            // Delete the old photo if it exists
            if ($photoPath && file_exists($photoPath)) {
                unlink($photoPath);
            }
               // Move the new uploaded file
            move_uploaded_file($img['tmp_name'], '../img/' . $img['name']);
            $data['photo'] = $img['name']; // Update the photo in the data array
        }

        $this->user($data);
        $result = $this->validateInput(false); // Skip duplicate email check during update

        if($result === true) {
            $this->update(
                $this->first_name, 
                $this->last_name, 
                $this->email,  
                $this->photo,  
                $this->bio,
                $data['id']
            );
        }
    }

    public function deleteUser($userId) {
        // Fetch user data to get the photo filename
        $user = $this->getUser($userId);
        
        // Check if the photo exists and delete it
        $photoPath = realpath('../img/' . $user['photo']);
        if ($photoPath && file_exists($photoPath)) {
            unlink($photoPath);
        }        
        
        // Delete the user from the database
        $this->delete($userId);
    }

    
}

