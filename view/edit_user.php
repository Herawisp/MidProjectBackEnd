<?php
require_once '../class/UsersController.php';

$usersController = new UsersController();
$user = null;
$error = "";

if (isset($_GET['id'])) {
    $user = $usersController->getOneUser($_GET['id']);
    if (!$user) {
        header("Location: dashboard.php?error=notfound");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usersController->updateUser($_POST, $_FILES['photo']);
    header("Location: dashboard.php?success=updated");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    
    <?php include 'template/header.php'; ?>

    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg">
        <h2 class="text-2xl font-semibold text-center mb-4">Edit User</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <p class="text-red-500 text-center mb-4">Error: <?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
        
        <form action="edit_user.php?id=<?= $user['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            
            <label class="block font-medium">First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required class="w-full p-2 border border-gray-300 rounded-lg">
            
            <label class="block font-medium">Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required class="w-full p-2 border border-gray-300 rounded-lg">
            
            <label class="block font-medium">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="w-full p-2 border border-gray-300 rounded-lg">
            
            <label class="block font-medium">Photo:</label>
            <div class="flex items-center space-x-4">
                <?php if ($user['photo']): ?>
                    <img src="../img/<?= htmlspecialchars($user['photo']) ?>" width="100" alt="User Photo" class="rounded-lg shadow-md">
                <?php endif; ?>
                <input type="file" name="photo" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            
            <label class="block font-medium">Bio:</label>
            <textarea name="bio" required class="w-full p-2 border border-gray-300 rounded-lg"> <?= htmlspecialchars($user['bio']) ?></textarea>
            
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">Update User</button>
        </form>
        
        <a href="dashboard.php" class="block text-center text-blue-600 mt-4 hover:underline">Back to Dashboard</a>
    </div>

    <?php include 'template/footer.php'; ?>
</body>
</html>
