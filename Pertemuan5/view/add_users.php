<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <?php include 'template/header.php';
    require '../class/UsersController.php';

    $uc = new UsersController();
    if(isset($_POST['addBtn'])){
        $uc->createUser($_POST, $_FILES['photo']);
        if ($result) {
            // Redirect to dashboard.php after successful creation
            header("Location: dashboard.php");
            exit(); // Ensure no further code is executed after redirection
        } else {
            // Handle error (e.g., show an error message)
            header("Location: dashboard.php?error=Failed to create user");
            exit();
        }
    }
    
    if(empty($_GET['error']) == false) {
        $uc->showError($_GET['error']); 
    }
    ?>
    
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4 text-center">Create User</h2>
            <form id="userForm" action = "" method="POST" enctype="multipart/form-data"  class="space-y-4">
                <div>
                    <label for="photo" class="block font-medium">Photo:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required class="w-full p-2 border border-gray-300 rounded-lg" onchange="previewImage(event)">
                    <img id="imagePreview" class="hidden mt-2 w-32 h-32 object-cover rounded-lg" alt="Image Preview">
                </div>
                
                <div>
                    <label for="first_name" class="block font-medium">First Name:</label>
                    <input type="text" id="first_name" name="first_name" maxlength="255" required class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                
                <div>
                    <label for="last_name" class="block font-medium">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" maxlength="255" required class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                
                <div>
                    <label for="email" class="block font-medium">Email:</label>
                    <input type="email" id="email" name="email" required class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                
                <div>
                    <label for="bio" class="block font-medium">Bio:</label>
                    <textarea id="bio" name="bio" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                
                <div class="text-right">
                    <button type="submit" name="addBtn" class="bg-blue-600 px-4 py-2 rounded-lg" >
                      <a type = "button" class = "text-white" >Create User</a>
                    </button>
                </div>
            </form>
        </div>
    </main>
    
    <?php include 'template/footer.php'; ?>
</body>
</html>
