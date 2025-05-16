<?php
// Include database configuration
require_once "config.php";

// Define variables and initialize with empty values
$full_name = $email = $password = $phone = "";
$full_name_err = $email_err = $password_err = $confirm_password_err = $phone_err = "";
$registration_success = false;

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate full name
    if (empty(trim($_POST["fullName"]))) {
        $full_name_err = "Please enter your full name.";
    } else {
        $full_name = trim($_POST["fullName"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirmPassword"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirmPassword"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Check input errors before inserting in database
    if (empty($full_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err)) {

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement
        $sql = "INSERT INTO users (full_name, email, password, phone) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_full_name, $param_email, $param_password, $param_phone);

            // Set parameters
            $param_full_name = $full_name;
            $param_email = $email;
            $param_password = $hashed_password;
            $param_phone = $phone;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $registration_success = true;
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!-- HTML Form with Error Messages -->
<?php include("./includes/header.php"); ?>
<body class="bg-gray-900 min-h-screen">
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-gray-800 rounded-lg shadow-xl w-full max-w-md p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-400">FITHUB</h1>
                <p class="text-pink-400 mt-2">Create your account</p>
            </div>

            <form id="registrationForm" action="register_process.php" method="POST" class="space-y-6">
                <!-- Full Name -->
                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-300">Full Name</label>
                    <input type="text" id="fullName" name="fullName" required class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo $full_name; ?>">
                    <span class="text-red-500"><?php echo $full_name_err; ?></span>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Email Address</label>
                    <input type="email" id="email" name="email" required class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo $email; ?>">
                    <span class="text-red-500"><?php echo $email_err; ?></span>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                    <input type="password" id="password" name="password" required class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-red-500"><?php echo $password_err; ?></span>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="text-red-500"><?php echo $confirm_password_err; ?></span>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-300">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required class="w-full pl-10 pr-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo $phone; ?>">
                    <span class="text-red-500"><?php echo $phone_err; ?></span>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Create Account</button>
                </div>

                <!-- Already have an account -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-300">Already have an account? <a href="login.php" class="text-blue-400 hover:underline">Log in</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
