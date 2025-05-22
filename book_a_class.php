<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$database = "fithub_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// hard coded user id for testing (first we make sure user is logged in already)
$user_id = 1;  // Replace with $_SESSION['user_id'] when login is implemented!

// handle cancel the bookings
if (isset($_GET['cancel_id'])) {
    $cancel_id = intval($_GET['cancel_id']);
    $stmtCancel = $conn->prepare("UPDATE user_class_bookings SET status = 'cancelled' WHERE id = ? AND user_id = ?");
    $stmtCancel->bind_param("ii", $cancel_id, $user_id);
    $stmtCancel->execute();
    $stmtCancel->close();

    // Redirect to avoid resubmission and show success message
    header("Location: book_a_class.php?cancelled=1");
    exit();
}

// Handle booking form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id = isset($_POST['schedule_id']) ? intval($_POST['schedule_id']) : 0;
    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';

    if ($schedule_id <= 0 || empty($booking_date)) {
        die("Invalid input.");
    }

    $sql = "INSERT INTO user_class_bookings (user_id, schedule_id, booking_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("iis", $user_id, $schedule_id, $booking_date);

    if ($stmt->execute()) {
        $booked_date = urlencode($booking_date);
        header("Location: book_a_class.php?success=1&date=$booked_date");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch current user's active bookings (status = booked)
$stmtBookings = $conn->prepare("SELECT id, schedule_id, booking_date FROM user_class_bookings WHERE user_id = ? AND status = 'booked' ORDER BY booking_date ASC");
$stmtBookings->bind_param("i", $user_id);
$stmtBookings->execute();
$bookingsResult = $stmtBookings->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book a Class - FitHub Gym</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">

  <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Book a Class</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Pilates -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-2">Pilates</h2>
        <p class="text-gray-600 mb-4">Improve your flexibility and posture with our Pilates class.</p>
        <form action="book_a_class.php" method="POST" class="space-y-2">
          <input type="hidden" name="schedule_id" value="1" />
          <label class="block text-sm font-medium text-gray-700">Select Date</label>
          <div class="relative">
            <input
              type="date"
              name="booking_date"
              required
              class="w-full border border-gray-300 rounded-md pl-10 pr-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Book Now</button>
        </form>
      </div>

      <!-- Spin Cycle -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-2">Spin Cycle</h2>
        <p class="text-gray-600 mb-4">High-intensity cycling to boost your endurance and burn calories.</p>
        <form action="book_a_class.php" method="POST" class="space-y-2">
          <input type="hidden" name="schedule_id" value="2" />
          <label class="block text-sm font-medium text-gray-700">Select Date</label>
          <div class="relative">
            <input
              type="date"
              name="booking_date"
              required
              class="w-full border border-gray-300 rounded-md pl-10 pr-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Book Now</button>
        </form>
      </div>

      <!-- Zumba -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-2">Zumba</h2>
        <p class="text-gray-600 mb-4">Dance your way to fitness with energetic and fun Zumba sessions.</p>
        <form action="book_a_class.php" method="POST" class="space-y-2">
          <input type="hidden" name="schedule_id" value="3" />
          <label class="block text-sm font-medium text-gray-700">Select Date</label>
          <div class="relative">
            <input
              type="date"
              name="booking_date"
              required
              class="w-full border border-gray-300 rounded-md pl-10 pr-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Book Now</button>
        </form>
      </div>

      <!-- CrossFit -->
      <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-2">CrossFit</h2>
        <p class="text-gray-600 mb-4">Push your limits with our intense CrossFit workouts.</p>
        <form action="book_a_class.php" method="POST" class="space-y-2">
          <input type="hidden" name="schedule_id" value="4" />
          <label class="block text-sm font-medium text-gray-700">Select Date</label>
          <div class="relative">
            <input
              type="date"
              name="booking_date"
              required
              class="w-full border border-gray-300 rounded-md pl-10 pr-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <i class="fas fa-calendar-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Book Now</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Current bookings list and cancel feature -->
  <div class="max-w-7xl mx-auto mt-16 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold mb-6">Your Bookings</h2>

    <?php if (isset($_GET['cancelled'])): ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Booking Cancelled',
          text: 'Your booking has been successfully cancelled.',
          confirmButtonColor: '#2563eb'
        });
      </script>
    <?php endif; ?>

    <?php if ($bookingsResult->num_rows > 0): ?>
      <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
        <thead>
          <tr class="bg-blue-600 text-white text-left">
        <thead>
          <tr class="bg-blue-600 text-white text-left">
            <th class="py-3 px-6">Class</th>
            <th class="py-3 px-6">Date</th>
            <th class="py-3 px-6">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Map schedule_id to class names (same as your booking cards)
          $classNames = [
            1 => 'Pilates',
            2 => 'Spin Cycle',
            3 => 'Zumba',
            4 => 'CrossFit'
          ];

          while ($booking = $bookingsResult->fetch_assoc()):
            $booking_id = $booking['id'];
            $schedule_id = $booking['schedule_id'];
            $booking_date = $booking['booking_date'];
            $className = isset($classNames[$schedule_id]) ? $classNames[$schedule_id] : 'Unknown';
          ?>
            <tr class="border-b hover:bg-gray-100">
              <td class="py-4 px-6"><?php echo htmlspecialchars($className); ?></td>
              <td class="py-4 px-6"><?php echo htmlspecialchars($booking_date); ?></td>
              <td class="py-4 px-6">
                <a
                  href="book_a_class.php?cancel_id=<?php echo $booking_id; ?>"
                  onclick="return confirm('Are you sure you want to cancel this booking?');"
                  class="text-red-600 hover:text-red-800 font-semibold"
                >Cancel</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-gray-600">You have no active bookings.</p>
    <?php endif; ?>

  </div>

  <?php if (isset($_GET['success'])): ?>
  <script>
    const bookedDate = "<?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?>";
    Swal.fire({
      icon: 'success',
      title: 'Class Booked!',
      html: `You’ve successfully booked your session on <strong>${bookedDate}</strong>.`,
      confirmButtonColor: '#2563eb'
    });
  </script>
  <?php endif; ?>

</body>
</html>
