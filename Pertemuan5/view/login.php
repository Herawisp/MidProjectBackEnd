<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
    <script>
        function validateLogin(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@(gmail\.com|binus\.ac\.id)$/;

            // Data Admin yang valid
            const adminEmail = "adminBNCC@gmail.com";
            const adminPasswordHash = "0192023a7bbd73250516f069df18b500"; // MD5 dari "Admin123"

            if (!email) {
                alert('Email cannot be empty.');
                return;
            }

            if (!emailPattern.test(email)) {
                alert('Invalid email format. Use @gmail.com or @binus.ac.id.');
                return;
            }

            if (!password) {
                alert('Password cannot be empty.');
                return;
            }

            // Hash password input user dengan MD5
            const inputPasswordHash = md5(password);

            // Cek apakah email dan password sesuai dengan admin
            if (email === adminEmail && inputPasswordHash === adminPasswordHash) {
                // Jika "Remember Me" dicentang, simpan email di localStorage
                if (rememberMe) {
                    localStorage.setItem('rememberedEmail', email);
                } else {
                    localStorage.removeItem('rememberedEmail');
                }

                window.location.href = 'dashboard.php';
            } else {
                alert('Invalid email or password.');
            }
        }

        // Cek localStorage saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            const rememberedEmail = localStorage.getItem('rememberedEmail');
            if (rememberedEmail) {
                document.getElementById('email').value = rememberedEmail;
                document.getElementById('rememberMe').checked = true;
            }
        });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold text-center mb-6">Admin Login</h1>

        <form onsubmit="validateLogin(event)">
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="w-full p-2 border border-gray-300 rounded-lg" 
                    placeholder="Enter your email"
                >
            </div>

            <!-- Password Input -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full p-2 border border-gray-300 rounded-lg" 
                    placeholder="Enter your password"
                >
            </div>

            <!-- Remember Me Checkbox -->
            <div class="mb-4 flex items-center">
                <input 
                    type="checkbox" 
                    id="rememberMe" 
                    name="rememberMe" 
                    class="mr-2"
                >
                <label for="rememberMe" class="text-gray-700">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="bg-blue-600 text-white w-full p-2 rounded-lg font-semibold">
                Login
            </button>
        </form>
    </div>
</body>
</html>