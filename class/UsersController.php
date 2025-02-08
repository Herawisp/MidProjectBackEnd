<?php
require 'Users.php';

class UsersController extends Users {
    private $first_name;
    private $last_name;
    private $email;
    private $photo;
    private $bio;
    private $pass;

    private function user($data) {
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->photo = $data['photo'] ?? null;
        $this->bio = $data['bio'];
        $this->pass = $data['password'] ?? null;
    }

    public function showUsers() {
        return $this->getAllUsers();
    }

    public function createUser($data, $img) {
        $this->user($data);
        $this->validateInput(false);

        $imageName = $img['name'] ? time() . "_" . basename($img['name']) : null;
        if ($imageName) {
            move_uploaded_file($img['tmp_name'], '../img/' . $imageName);
        }

        $hashedPassword = password_hash($this->pass, PASSWORD_DEFAULT);

        $this->setUser(
            $this->first_name, 
            $this->last_name, 
            $this->email, 
            $imageName, 
            $hashedPassword, 
            $this->bio
        );
    }

    public function getOneUser($id) {
        return $this->getUser($id);
    }

    private function validateInput($checkDuplicateEmail = true) {
        if (!$this->isNotEmptyInput()) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=emptyinput" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        if (!$this->isEmail()) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=email" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        if ($checkDuplicateEmail && $this->duplicateEmail()) {
            header("Location:" . $_SERVER['PHP_SELF'] . "?error=dupemail" . (isset($_GET['id']) ? "&id=" . $_GET['id'] : ""));
            exit();
        }

        return true;
    }

    private function duplicateEmail() {
        $duplicates = $this->getUserEmail($this->email);
        return count($duplicates) > 0;
    }

    private function isNotEmptyInput() {
        return !empty($this->first_name) &&
               !empty($this->last_name) &&
               !empty($this->email) &&
               !empty($this->bio);
    }

    private function isEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function showError($error) {
        $errors = [
            'emptyinput' => "Please fill in all required fields.",
            'dupemail' => "Duplicate email address.",
            'email' => "Invalid email address.",
            'unknown' => "An unknown error occurred."
        ];
        $message = $errors[$error] ?? $errors['unknown'];
        echo '<script>alert("' . $message . '");</script>';
    }

    public function updateUser($data, $img) {
        $old_data = $this->getUser($data['id']);
        $data['photo'] = $old_data['photo'];

        if (!empty($img['tmp_name'])) {
            $oldPhotoPath = '../img/' . $old_data['photo'];
            
            if (!empty($old_data['photo']) && file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }

            $imageName = time() . "_" . basename($img['name']);
            move_uploaded_file($img['tmp_name'], '../img/' . $imageName);
            $data['photo'] = $imageName;
        }

        $this->user($data);
        if ($this->validateInput(false)) {
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
        $user = $this->getUser($userId);
        if (!empty($user['photo'])) {
            $photoPath = '../img/' . $user['photo'];
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        $this->delete($userId);
    }
}
