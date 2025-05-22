<?php
session_start();
require_once "config.php"; // Database connection

// ✅ Make sure user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["id"];

// 🔍 Get user's membership details
$sql = "
    SELECT u.full_name, m.name AS plan_name, m.description, m.price, m.duration_days, m.created_at
    FROM users u
    JOIN memberships m ON u.membership_id = m.id
    WHERE u.id = ?
";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $full_name = $row["full_name"];
        $plan_name = $row["plan_name"];
        $description = $row["description"];
        $price = $row["price"];
        $duration_days = $row["duration_days"];
        $start_date = date("Y-m-d", strtotime($row["created_at"]));
        $expiry_date = date("Y-m-d", strtotime($row["created_at"] . " +$duration_days days"));
    } else {
        echo "Membership details not found.";
        exit;
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Database error.";
    exit;
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Membership Details</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: #fff;
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .container {
            background: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
        }
        h2 {
            color: #4caf50;
            margin-bottom: 20px;
        }
        .detail {
            margin-bottom: 12px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello, <?php echo htmlspecialchars($full_name); ?> 👋</h2>
        <div class="detail"><span class="label">Plan:</span> <?php echo htmlspecialchars($plan_name); ?></div>
        <div class="detail"><span class="label">Description:</span> <?php echo htmlspecialchars($description); ?></div>
        <div class="detail"><span class="label">Price:</span> $<?php echo htmlspecialchars($price); ?></div>
        <div class="detail"><span class="label">Start Date:</span> <?php echo $start_date; ?></div>
        <div class="detail"><span class="label">Expiry Date:</span> <?php echo $expiry_date; ?></div>
    </div>
</body>
</html>
