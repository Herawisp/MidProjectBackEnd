<?php 
include 'template/header.php';
include '../class/UserController.php';


$uc = new UserController();
$user = $uc->getOneUser($_GET['id']);
?>

<!-- Table -->
<div class="container my-5">
    <div class="card mx-auto" style="width: 150vh;">
        <div class="card-header bg-dark text-white text-center">
            <h3>View User</h3>
        </div>

        <div class="card-body bg-dark text-white d-flex align-items-center">
            <!-- Image Preview Section -->
            <div class="image-preview-container me-5">
                <!-- Display Profile Image -->
                <img id="imagePreview" src="<?= !empty($user['photo']) ? '../img/' . $user['photo'] : 'https://via.placeholder.com/180x150'; ?>" alt="Profile Image" class="img-fluid rounded-circle mb-3" style="width: 500px; height: 300px; object-fit: cover;">
            </div>
            <!-- User Information Section -->
            <div class="w-100">
                <p><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                <p><strong>Password:</strong> <?php echo $user['pass']; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
                <p><strong>Description:</strong> <?php echo $user['description']; ?></p>

                <!-- Close Button -->
                <div class="text-center">
                    <a type="button" class="btn btn-secondary w-100 mt-3" href="index.php">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php'?>