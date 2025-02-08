<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
<?php include 'template/header.php'; ?>

    

    <!-- Main Content -->
    <main class="container mx-auto my-6 flex-grow">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
            <h1 class="text-2xl font-bold mb-4 text-center">Admin Profile</h1>

            <!-- Profile Information -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">First Name</label>
                <p class="bg-gray-100 p-2 rounded-lg">Admin</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Last Name</label>
                <p class="bg-gray-100 p-2 rounded-lg">BNCC</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Email</label>
                <p class="bg-gray-100 p-2 rounded-lg">adminBNCC@gmail.com</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold">Bio</label>
                <p class="bg-gray-100 p-2 rounded-lg">Hi my name is Admin, and I like backend development.</p>
            </div>

            <!-- Log Out Button -->
            <div class="text-center">
                <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                    <a href="login.php" class="text-white">log out</a>
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'template/footer.php'; ?>

</body>
</html>