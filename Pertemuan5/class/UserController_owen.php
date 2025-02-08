<?php 
require_once 'Users.php';

class UserController extends Users {
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $photo;
    private $dob; //Date of Birth
    private $desc; //Description

    private function user($data) {
        $this->first_name = $data['firstName'];
        $this->last_name = $data['lastName'];
        $this->email = $data['email'];
        $this->password = $data['pass'];
        $this->photo = $data['photo'];
        $this->dob = $data['dob'];
        $this->desc = $data['description'];
    }

    //Method to Show all of the Users
    public function showUsers(){
        $results = $this->getAllUsers();
        return $results;
    }

    public function getOneUser($id) {
        $result = $this->getUser($id);
        return $result;
    }
    
    // Method to handle creating a user
    public function createUser($data, $img) {
        $this->user($data);

        // Validate user input
        $result = $this->validateInput(false); // Skip duplicate email check during update

        if($result === true){
            move_uploaded_file($img['tmp_name'], '../img/' . $img['name']);
            $password = md5($this->password);
            $this->setUser(
                $this->first_name, 
                $this->last_name, 
                $this->email, 
                $password, 
                $img['name'], 
                $this->dob, 
                $this->desc
            );
        }
    }
    public function createUser_eldwin($data, $img) {
        $this->user($data);
        var_dump($img);
        $this->validateInput(false);
        move_uploaded_file($img['tmp_name'], '../img/' . $img['name']);
        $this->setUser(
            $this->first_name, 
            $this->last_name, 
            $this->email, 
            $img['name'],
            $this->bio);
    }
    // Method to handle updating a user
    public function updateUser($data, $img) {
        $old_data = $this->getUser($data['id']);
        $data['photo'] = $old_data['photo']; // Retain the old photo by default
        
        // Check if a valid image was uploaded
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

        // Validate user input
        $result = $this->validateInput(false); // Skip duplicate email check during update

        if($result === true) {
            $this->update(
                $this->first_name, 
                $this->last_name, 
                $this->email, 
                $this->password, 
                $this->photo, 
                $this->dob, 
                $this->desc,
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

    private function isNotEmptyInput() {
        if (empty($this->first_name) || empty($this->last_name) || empty($this->email) || empty($this->password) || empty($this->dob) || empty($this->desc)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

    private function isEmail() {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }
}