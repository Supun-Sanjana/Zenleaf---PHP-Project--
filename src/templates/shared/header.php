<?php
// header.php (or navbar.php) - place at top of page includes
session_start();

// Make sure your session cart structure is like:
// $_SESSION['cart'] = [
//   ['id'=>1,'name'=>'Aloe Vera','price'=>12.99,'quantity'=>2],
//   ...
// ];
$cart = $_SESSION['cart'] ?? [];

// compute totals & item count (sum of quantities)
$total = 0.0;
$itemCount = 0;
foreach ($cart as $it) {
    $qty = isset($it['quantity']) ? (int)$it['quantity'] : 1;
    $price = isset($it['price']) ? (float)$it['price'] : 0.0;
    $total += $qty * $price;
    $itemCount += $qty;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ZenLeaf</title>

  <!-- Tailwind (only once) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome (no integrity attr to avoid mismatch) -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Flowbite (optional) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50">
  <!-- NAVBAR -->
  <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-2">
          <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
            </svg>
          </div>
          <span class="text-xl font-bold text-gray-900">ZenLeaf</span>
        </a>

        <!-- Links -->
        <div class="hidden md:flex space-x-8">
          <a href="#indoor" class="text-gray-700 hover:text-emerald-600 transition-colors">Indoor</a>
          <a href="#flowering" class="text-gray-700 hover:text-emerald-600 transition-colors">Flowering</a>
          <a href="#miniature" class="text-gray-700 hover:text-emerald-600 transition-colors">Miniature</a>
          <a href="#accessories" class="text-gray-700 hover:text-emerald-600 transition-colors">Plant Care</a>
          <a href="#about" class="text-gray-700 hover:text-emerald-600 transition-colors">About</a>
        </div>

        <!-- Right side: cart + auth -->
        <div class="relative flex items-center space-x-4">
          <!-- CART BUTTON -->
          <button id="cart-btn" aria-controls="cart-panel" aria-expanded="false"
            class="relative text-gray-700 hover:text-emerald-600 focus:outline-none" type="button">
            <!-- simple cart icon -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
              stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart">
              <circle cx="8" cy="21" r="1" />
              <circle cx="19" cy="21" r="1" />
              <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg>

            <?php if ($itemCount > 0): ?>
              <span
                class="absolute -top-2 -right-2 bg-emerald-500 text-white text-xs px-1 rounded-full"><?php echo $itemCount; ?></span>
            <?php endif; ?>
          </button>

          <!-- User block (toggle dropdown) -->
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="relative">
              <?php $userName = $_SESSION['user_name'] ?? 'U'; $letter = strtoupper(substr($userName, 0, 1)); ?>
              <button id="user-dropdown-toggle" onclick="document.getElementById('dropdown-menu').classList.toggle('hidden')"
                class="flex items-center focus:outline-none" type="button">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-lg"><?php echo $letter; ?></div>
              </button>

              <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg py-2 z-50">
                <a href="/update_profile.php" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-emerald-400">Update Profile</a>
                <a href="/auth_logout.php" class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-emerald-400">Logout</a>
              </div>
            </div>
          <?php else: ?>
            <a href="/login.php"
              class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <!-- Overlay (clicking it closes the cart) -->
  <div id="overlay" class="fixed inset-0 bg-black/50 hidden z-40"></div>

  <!-- Cart Side Panel -->
  <aside id="cart-panel"
    class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-50 flex flex-col"
    aria-hidden="true" role="dialog" aria-label="Shopping cart">
    <div class="flex justify-between items-center p-4 border-b">
      <h2 class="text-lg font-semibold text-emerald-600">Shopping Cart</h2>
      <button id="close-cart" aria-label="Close cart" class="text-gray-600 hover:text-red-500" type="button">
        <i class="fa-solid fa-xmark text-xl"></i>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-4 space-y-4">
      <?php if (!empty($cart)): ?>
        <?php foreach ($cart as $item):
            $qty = isset($item['quantity']) ? (int)$item['quantity'] : 1;
            $price = isset($item['price']) ? (float)$item['price'] : 0.0;
        ?>
          <div class="flex justify-between items-center border-b pb-2">
            <div>
              <p class="font-medium"><?php echo htmlspecialchars($item['name']); ?></p>
              <p class="text-sm text-gray-600">$<?php echo number_format($price, 2); ?> × <?php echo $qty; ?></p>
            </div>
            <span class="font-semibold">$<?php echo number_format($price * $qty, 2); ?></span>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-gray-500">Your cart is empty.</p>
      <?php endif; ?>
    </div>

    <?php if (!empty($cart)): ?>
      <div class="p-4 border-t">
        <p class="flex justify-between text-lg font-semibold">
          <span>Total:</span> <span>$<?php echo number_format($total, 2); ?></span>
        </p>
        <a href="/checkout.php"
          class="block text-center w-full mt-4 bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded-lg font-medium transition-colors">Proceed to Checkout</a>
      </div>
    <?php endif; ?>
  </aside>

  <!-- Add a top padding to offset the fixed navbar for page content -->
  <div class="pt-16">
    <!-- page content starts here -->
</div>


</body>
<!-- scripts: place before </body> -->
<script>
  (function () {
    const cartBtn = document.getElementById('cart-btn');
    const cartPanel = document.getElementById('cart-panel');
    const overlay = document.getElementById('overlay');
    const closeBtn = document.getElementById('close-cart');
    const userToggle = document.getElementById('user-dropdown-toggle');
    const dropdown = document.getElementById('dropdown-menu');

    function openCart() {
      if (!cartPanel || !overlay) return;
      cartPanel.classList.remove('translate-x-full');
      cartPanel.setAttribute('aria-hidden', 'false');
      overlay.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      if (cartBtn) cartBtn.setAttribute('aria-expanded', 'true');
    }

    function closeCart() {
      if (!cartPanel || !overlay) return;
      cartPanel.classList.add('translate-x-full');
      cartPanel.setAttribute('aria-hidden', 'true');
      overlay.classList.add('hidden');
      document.body.style.overflow = '';
      if (cartBtn) cartBtn.setAttribute('aria-expanded', 'false');
    }

    if (cartBtn) cartBtn.addEventListener('click', function (e) { e.stopPropagation(); openCart(); });
    if (closeBtn) closeBtn.addEventListener('click', function (e) { e.stopPropagation(); closeCart(); });
    if (overlay) overlay.addEventListener('click', closeCart);

    // close with Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        if (cartPanel && !cartPanel.classList.contains('translate-x-full')) closeCart();
        // also close dropdown if open
        if (dropdown && !dropdown.classList.contains('hidden')) dropdown.classList.add('hidden');
      }
    });

    // Close user dropdown when clicked outside
    document.addEventListener('click', function (e) {
      if (!dropdown) return;
      // if the click is not inside dropdown AND not on the toggle button -> hide
      if (!dropdown.contains(e.target) && !(userToggle && userToggle.contains(e.target))) {
        dropdown.classList.add('hidden');
      }
    });

    // Optional: keep keyboard focus usable — focus close button when open
    // (improvement: implement focus trap for accessibility)
    if (cartBtn && closeBtn) {
      cartBtn.addEventListener('click', () => closeBtn.focus());
    }
  })();
</script>

<!-- flowbite (optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>


</html>