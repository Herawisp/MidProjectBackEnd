<?php 
require '../class/UsersController.php';


$uc = new UsersController();
$users = $uc->showUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<script>
function confirmDelete(userId) {
    let confirmAction = confirm("Are you sure you want to delete this user?");
    if (confirmAction) {
        window.location.href = "delete_user.php?id=" + userId;
    }
}
</script>

    <body class="bg-gray-100 min-h-screen flex flex-col">
    <?php include 'template/header.php'; ?>

    <main class="container mx-auto my-6 flex-grow">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Id</th>
                        <th class="px-4 py-2">Photo</th>
                        <th class="px-4 py-2">Full Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center"><?php echo $user['id'] ?></td>
                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center">
                                <img src="<?= !empty($user['photo']) ? '../img/' . $user['photo'] : 'https://via.placeholder.com/180x150'; ?>" alt="User Photo" class="rounded-lg shadow-md w-24 h-24 object-cover">
                            </div>
                        </td>

                        <td class="px-4 py-2 text-center"><?php echo $user['first_name'] . ' '. $user['last_name']?></td>
                        <td class="px-4 py-2 text-center"><?php echo $user['email'] ?></td>
                        <td class="px-4 py-2 text-center">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-lg mr-2">
                                <a href="view_user.php?id=<?php echo $user['id']; ?>" class="text-white">View</a>                                  
                                </button>
                            <button class="bg-yellow-500 text-white px-3 py-1 rounded-lg mr-2">
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="text-white">Edit</a>
                            </button>
                            <button 
                                class="bg-red-500 text-white px-3 py-1 rounded-lg"
                                onclick="confirmDelete(<?php echo $user['id']; ?>)"> Delete
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-right">
            <button class="bg-blue-600 px-4 py-2 rounded-lg">
            <a href="add_users.php" class="text-white">Add New User</a>
            </button>
        </div>
        
    </main>

    <?php include 'template/footer.php'; ?>

</body>
</html>