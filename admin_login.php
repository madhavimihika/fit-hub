<?php
session_start();

// Hardcoded admin credentials
$admin_email = "admin@fithub.com";
$admin_password = "admin123"; // Plaintext password

// If already logged in as admin, redirect
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["role"] === "admin") {
    header("location: admin_dashboard.php");
    exit;
}

// Initialize variables
$email = $password = "";
$errors = [];

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email check
    if (empty(trim($_POST["email"]))) {
        $errors[] = "Email is required.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Password check
    if (empty(trim($_POST["password"]))) {
        $errors[] = "Password is required.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Only proceed if no input errors
    if (empty($errors)) {
        // Check if the email and password match the hardcoded admin credentials
        if ($email === $admin_email && $password === $admin_password) {
            // Success - set session
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $admin_email;
            $_SESSION["role"] = "admin";

            // Redirect to dashboard
            header("location: admin_dashboard.php");
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<?php include("./includes/header.php"); ?>
<body class="bg-gray-900 min-h-screen">
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-400">FITHUB</h1>
                <p class="text-pink-400 mt-2">Admin Login</p>
            </div>

            <!-- Show all errors -->
            <?php if (!empty($errors)): ?>
                <div class="mb-4 p-3 bg-red-900 text-white rounded-md">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-md">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 text-white rounded-md">
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
                        Sign In
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php" class="text-sm text-blue-400 hover:underline">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Main Website
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
