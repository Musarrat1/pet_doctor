<?php
// No PHP logic here for now, just static page.
// You can enhance this by fetching services from DB if you want dynamic.

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pet Paradise - Services</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<header class="bg-white shadow">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-black-700">Pet<br> House</h1>
    <nav>
      <ul class="flex space-x-6">
        <li><a href="index.html" class="hover:text-yellow-400">Home</a></li>
        <li><a href="store.php" class="hover:text-yellow-400">Shop</a></li>
        <li><a href="services.php" class="text-yellow-400">Services</a></li>
        <li><a href="contact.html" class="hover:text-yellow-400">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<section class="bg-yellow-500 text-white py-16 text-center">
  <h2 class="text-4xl font-bold mb-4">Personal Pet Caring Services</h2>
  <p class="text-lg max-w-xl mx-auto">Our professionals treat your pet like their own — with love, care, and attention.</p>
</section>

<section class="py-16">
  <div class="container mx-auto px-6">
    <div id="serviceGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Visible services -->
      <div class="service-card bg-white p-6 rounded-2xl shadow">
        <h3 class="text-xl font-semibold text-black-700 mb-2">Home Sitting</h3>
        <p class="text-gray-600 mb-4">Your pet stays comfortable in their own home with daily sitter visits.</p>
        <button data-service="Home Sitting" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>
      <div class="service-card bg-white p-6 rounded-2xl shadow">
        <h3 class="text-xl font-semibold text-black-700 mb-2"> Overnight Boarding</h3>
        <p class="text-gray-600 mb-4">Safe, cozy environment for overnight stays with constant care.</p>
        <button data-service="Overnight Boarding" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>
      <div class="service-card bg-white p-6 rounded-2xl shadow">
        <h3 class="text-xl font-semibold text-black-700 mb-2">Dog Walking</h3>
        <p class="text-gray-600 mb-4">Personalized walks for all sizes and breeds, rain or shine!</p>
        <button data-service="Dog Walking" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>

      <!-- Hidden services -->
      <div class="service-card bg-white p-6 rounded-2xl shadow hidden">
        <h3 class="text-xl font-semibold text-black-700 mb-2">Grooming</h3>
        <p class="text-gray-600 mb-4">Bathing, brushing, nail trimming, and more with premium products.</p>
        <button data-service="Grooming" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>
      <div class="service-card bg-white p-6 rounded-2xl shadow hidden">
        <h3 class="text-xl font-semibold text-black-700 mb-2"> Medication Support</h3>
        <p class="text-gray-600 mb-4">Skilled staff helps administer medicine and post-surgery care.</p>
        <button data-service="Medication Support" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>
      <div class="service-card bg-white p-6 rounded-2xl shadow hidden">
        <h3 class="text-xl font-semibold text-black-700 mb-2">Pet Nanny</h3>
        <p class="text-gray-600 mb-4">Full-day companionship with fun activities and watchful eyes.</p>
        <button data-service="Pet Nanny" class="book-btn bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Book Now</button>
      </div>
    </div>

    <div class="text-center mt-10">
      <button id="toggleBtn" class="bg-yellow-500 text-white px-6 py-3 rounded hover:bg-yellow-600 transition">Show More</button>
    </div>
  </div>
</section>

<!-- Booking Modal -->
<div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
  <div class="bg-white rounded-lg max-w-md w-full p-6 relative">
    <button id="closeModal" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
    <h3 class="text-xl font-bold mb-4 text-purple-700">Book Service</h3>
    <form id="bookingForm" method="POST" action="book_service.php" class="space-y-4">
      <input type="hidden" name="service_name" id="service_name" />
      <div>
        <label class="block mb-1 font-semibold">Your Name *</label>
        <input type="text" name="customer_name" required class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>
      <div>
        <label class="block mb-1 font-semibold">Email *</label>
        <input type="email" name="customer_email" required class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>
      <div>
        <label class="block mb-1 font-semibold">Phone</label>
        <input type="tel" name="customer_phone" class="w-full border border-gray-300 rounded px-3 py-2" />
      </div>
      <div>
        <label class="block mb-1 font-semibold">Preferred Booking Date *</label>
        <input type="date" name="booking_date" required class="w-full border border-gray-300 rounded px-3 py-2" min="<?= date('Y-m-d') ?>" />
      </div>
      <div class="text-right">
        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">Submit</button>
      </div>
    </form>
  </div>
</div>

<footer class="bg-yellow-500 text-black-300 text-center py-6 mt-16">
  <p>© 2025 Pet Paradise. All rights reserved.</p>
</footer>

<script>
  // Toggle hidden services
  const toggleBtn = document.getElementById('toggleBtn');
  const hiddenCards = document.querySelectorAll('.service-card.hidden');
  let expanded = false;
  toggleBtn.addEventListener('click', () => {
    hiddenCards.forEach(card => card.classList.toggle('hidden'));
    expanded = !expanded;
    toggleBtn.textContent = expanded ? 'Show Less' : 'Show More';
  });

  // Modal elements
  const bookingModal = document.getElementById('bookingModal');
  const closeModalBtn = document.getElementById('closeModal');
  const bookingForm = document.getElementById('bookingForm');
  const serviceNameInput = document.getElementById('service_name');

  // Show modal when Book Now clicked
  document.querySelectorAll('.book-btn').forEach(button => {
    button.addEventListener('click', () => {
      const service = button.getAttribute('data-service');
      serviceNameInput.value = service;
      bookingModal.classList.remove('hidden');
    });
  });

  // Close modal handler
  closeModalBtn.addEventListener('click', () => {
    bookingModal.classList.add('hidden');
    bookingForm.reset();
  });

  // Close modal when clicking outside the modal content
  bookingModal.addEventListener('click', e => {
    if (e.target === bookingModal) {
      bookingModal.classList.add('hidden');
      bookingForm.reset();
    }
  });

  // Optionally add client-side validation here

</script>

</body>
</html>
