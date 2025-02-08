<?php 
require '../class/UsersController.php';



$uc = new UsersController();
$user = $uc->getOneUser($_GET['id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <?php include 'template/header.php'; ?>

    <main class="container mx-auto my-6 flex-grow">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row items-center md:items-start">
            
            <div class="w-full md:w-1/3 flex justify-center mb-4 md:mb-0">
                <img src="<?= !empty($user['photo']) ? '../img/' . $user['photo'] : 'https://via.placeholder.com/180x150'; ?>" alt="User Photo" class="rounded-lg shadow-md">
            </div>
            
            <div class="w-full md:w-2/3 md:pl-6 flex flex-col justify-between items-stretch">
                <h2 class="text-2xl font-bold mb-4">User Details</h2>
                <div class="border-t pt-4 space-y-2 flex-grow">
                    <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
                    <p><strong>Full Name:</strong> <?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Password:</strong> <?php echo $user['password']; ?></p>
                    <p><strong>Bio:</strong> <?php echo $user['bio']; ?></p>
                </div>
                <div class="mt-6 flex justify-end">
                    <a href="dashboard.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Back to Dashboard</a>
                </div>
            </div>

        </div>
    </main>

    <?php include 'template/footer.php'; ?>
</body>
</html>
