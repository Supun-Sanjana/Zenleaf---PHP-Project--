<?php
session_start();

// If cart is empty
$cart = $_SESSION['cart'] ?? [];
$total = 0;

//   require_once './header.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-emerald-700 mb-6">Your Cart 🛒</h1>

        <?php if (empty($cart)): ?>
            <p class="text-gray-600">Your cart is empty.</p>
            <a href="../public/shop.php" class="text-emerald-600 underline">Continue Shopping</a>
        <?php else: ?>
            <form action="../src/backend/update_cart.php" method="POST">
                <table class="w-full border-collapse mb-6">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 text-left">Product</th>
                            <th class="py-2">Price</th>
                            <th class="py-2">Quantity</th>
                            <th class="py-2">Subtotal</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $id => $item):
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                            ?>
                            <tr class="border-b">
                                <td class="py-2 flex items-center gap-3">
                                    <img src="./products/<?= htmlspecialchars($item['image']) ?>"
                                        class="w-12 h-12 object-cover rounded">
                                    <?= htmlspecialchars($item['name']) ?>
                                </td>
                                <td class="text-center">$<?= number_format($item['price'], 2) ?></td>
                                <td class="text-center">
                                    <input type="number" name="quantity[<?= $id ?>]" value="<?= $item['quantity'] ?>" min="1"
                                        class="w-16 border rounded px-2 py-1 text-center">
                                </td>
                                <td class="text-center">$<?= number_format($subtotal, 2) ?></td>
                               
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="flex justify-between items-center">
                    <div>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded hover:bg-emerald-700">
                            Update Cart
                        </button>
                        <a href="../../../public/shop.php" class="ml-4 text-emerald-600 underline">Continue Shopping</a>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold">Total: $<?= number_format($total, 2) ?></p>
                        <a href="../shared/Payhere/index.php"
                            class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Checkout
                        </a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>