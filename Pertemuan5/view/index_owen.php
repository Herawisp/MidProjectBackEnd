<?php 
include 'template/header.php';
include '../class/UserController.php';


$users = $uc->showUsers();

?>

<!-- Table -->
<div class="container my-5 table-responsive-xl">
    <table class="table table-hover caption-top mt-5 fs-4">
        <div class="d-flex justify-content-between">
            <h1 class="text-white">List of Users</h1>
            <h1 class="text-white">Admin : Owen</h1>
        </div>
        <thead class="table-dark text-center">
        <tr>
            <th scope="col" style="width: 50px;">No</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody class="text-center table-dark table-group-divider">
            <?php 
                $num = 1;
                foreach($users as $user):
            ?>
            <tr>
                <td><?= $num++;?></td>
                <td><?= $user['first_name'] . ' ' . $user['last_name']; ?></td>
                <td><?= $user['email']; ?></td>
                <td>
                    <a href="" class="btn btn-primary btn-md">View</a>
                    <a href="" class="btn btn-warning btn-md">Edit</a>
                    <a href="" class="btn btn-danger btn-md" onclick="">Remove</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <!-- Add User Button -->
    <div class="text-center my-5">
        <a href="" class="btn btn-primary">+ Add User</a>
    </div>
</div>

<?php include 'template/footer.php'?>