<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FitLife Gym - Membership Benefits</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Tailwind Custom Config (Optional if needed for themes) -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
</head>
<body class="bg-white text-gray-800 font-sans">

  <!-- MEMBERSHIP BENEFITS SECTION -->
  <section class="bg-gradient-to-b from-sky-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl sm:text-5xl font-extrabold text-center text-gray-800 mb-16">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-teal-400">Membership Benefits</span>
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        <!-- CARD 1 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-blue-600">
          <div class="text-blue-600 text-5xl mb-4">
            <i class="fas fa-dumbbell"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Unlimited Gym Access</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> 24/7 Open Hours</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Premium Equipment</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Strength & Cardio Zones</li>
          </ul>
        </div>

        <!-- CARD 2 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-pink-500">
          <div class="text-pink-500 text-5xl mb-4">
            <i class="fas fa-users"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Group Fitness Classes</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Zumba, HIIT, Yoga & More</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Expert Instructors</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Flexible Schedules</li>
          </ul>
        </div>

        <!-- CARD 3 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-green-500">
          <div class="text-green-500 text-5xl mb-4">
            <i class="fas fa-apple-alt"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Nutrition Guidance</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Personalized Meal Plans</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> One-on-One Consults</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Smart Tracking Tools</li>
          </ul>
        </div>

        <!-- CARD 4 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-purple-500">
          <div class="text-purple-500 text-5xl mb-4">
            <i class="fas fa-spa"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Wellness & Recovery</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Sauna & Steam Rooms</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Recovery Lounge</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Massage Therapy</li>
          </ul>
        </div>

        <!-- CARD 5 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-yellow-500">
          <div class="text-yellow-500 text-5xl mb-4">
            <i class="fas fa-calendar-check"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Priority Booking</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Reserve Classes Early</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Guaranteed Spots</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> No Waiting Lists</li>
          </ul>
        </div>

        <!-- CARD 6 -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 p-8 border-t-4 border-red-500">
          <div class="text-red-500 text-5xl mb-4">
            <i class="fas fa-percent"></i>
          </div>
          <h3 class="text-2xl font-semibold mb-4">Member-Only Discounts</h3>
          <ul class="space-y-2">
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Fithub Merchandise</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Supplements & Gear</li>
            <li class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Partner Store Deals</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
