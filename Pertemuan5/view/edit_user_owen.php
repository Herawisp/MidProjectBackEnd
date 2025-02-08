
<?php 
include 'template/header.php';
include '../class/UserController.php';

$uc = new UserController();
$user = $uc->getOneUser($_GET['id']);

if(isset($_POST['updateBtn'])){
    $uc->updateUser($_POST, $_FILES['photo']);
    header("Location: index.php");
}

if(empty($_GET['error']) == false) {
    $uc->showError($_GET['error']); 
}
?>

<!-- Table -->
<div class="container my-5">
    <div class="card mx-auto" style="width: 150vh;">
        <div class="card-header bg-dark text-white text-center">
            <h3>Edit User</h3>
        </div>

        <div class="card-body bg-dark text-white d-flex align-items-center">
            <!-- Image Preview Section -->
            <div class="image-preview-container me-5">
                <img id="imagePreview" src="<?= $user['photo'] ? '../img/' . $user['photo'] : 'https://via.placeholder.com/380x300'; ?>" class="img-fluid rounded-circle mb-3" style="width: 380px; height: 300px; object-fit: cover;">
            </div>
            <!-- Form Section -->
            <div class="form-section w-100">
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user["id"]?>">
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="imageUpload" name="photo" accept="image/*">
                    </div>

                    <!-- First Name -->
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="Enter first name" value="<?php echo $user['first_name']; ?>" >
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="lastName" placeholder="Enter last name" value="<?php echo $user['last_name']; ?>">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $user['email']; ?>">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="pass" placeholder="Enter password" value="<?php echo $user['pass']; ?>">
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['dob']; ?>">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a brief description"><?php echo $user['description']; ?></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" name="updateBtn" class="btn btn-success w-100">Update User</button>
                        <a type="button" class="btn btn-secondary w-100 mt-3" href="index.php">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?php include 'template/footer.php'?>