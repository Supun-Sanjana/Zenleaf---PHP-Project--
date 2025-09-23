<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenLeaf Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        .leaf-decoration {
            background-color: rgba(45, 212, 191, 0.1);
            border-radius: 9999px 0;
            animation: float 8s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">

    <header class="bg-gray-800 p-4 shadow-lg flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <h1 class="text-2xl font-bold text-emerald-400">ZenLeaf</h1>
            <nav>
                <a href="index.php?page=products" class="text-gray-300 hover:text-white px-3 py-2 rounded-md transition-colors">Products</a>
                <a href="index.php?page=suppliers" class="text-gray-300 hover:text-white px-3 py-2 rounded-md transition-colors">Suppliers</a>
                <a href="#" class="text-gray-300 hover:text-white px-3 py-2 rounded-md transition-colors">Settings</a>
            </nav>
        </div>
        <div>
            <span class="text-sm">Welcome, Admin</span>
        </div>
    </header>

    <main class="p-6">
        <?php
            // Simple router to include the correct page
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            switch($page) {
                case 'products':
                    include 'products.php';
                    break;
                case 'suppliers':
                    include 'suppliers.php';
                    break;
                default:
                    // You can create a dashboard page here
                    echo '<h2 class="text-3xl font-bold text-white mb-6">Dashboard Overview</h2>';
                    echo '<p class="text-gray-400">Welcome to the ZenLeaf Admin Panel. Use the navigation to manage your products and suppliers.</p>';
                    break;
            }
        ?>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>