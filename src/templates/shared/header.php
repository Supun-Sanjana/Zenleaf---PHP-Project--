<?php
// We start the session on every page to check for login status.
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenLeaf</title>

    <!-- FIX 1: Added the required Tailwind CSS script -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <!-- The <body> tag is opened here, and will be closed in the footer.php file -->

    <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/Zenleaf---PHP-Project--/public/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">ZenLeaf</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="#indoor" class="text-gray-700 hover:text-emerald-600 transition-colors">Indoor</a>
                    <a href="#flowering" class="text-gray-700 hover:text-emerald-600 transition-colors">Flowering</a>
                    <a href="#miniature" class="text-gray-700 hover:text-emerald-600 transition-colors">Miniature</a>
                    <a href="#accessories" class="text-gray-700 hover:text-emerald-600 transition-colors">Plant Care</a>
                    <a href="#about" class="text-gray-700 hover:text-emerald-600 transition-colors">About</a>
                </div>

                <!-- Auth Buttons -->
                <div class="relative flex items-center space-x-4">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Profile Image Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button onclick="document.getElementById('dropdown-menu').classList.toggle('hidden')"
                                class="flex items-center focus:outline-none">
                                <?php
                                $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'U';
                                $letter = strtoupper(substr($userName, 0, 1));
                                ?>

                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-emerald-600 text-white font-bold text-lg">
                                    <?php echo $letter; ?>
                                </div>

                                <!-- Dropdown Menu -->
                                <div id="dropdown-menu"
                                    class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg py-2 z-50">
                                    <a href="../public/update_profile.php"
                                        class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-emerald-400 transition-colors">Update
                                        Profile</a>
                                    <a href="../src/backend/customer/auth_logout.php"
                                        class="block px-4 py-2 text-gray-200 hover:bg-gray-700 hover:text-emerald-400 transition-colors">Logout</a>
                                </div>
                        </div>
                    <?php else: ?>
                        <!-- Guest User -->
                        <a href="../public/login.php"
                            class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">
                            Login
                        </a>
                    <?php endif; ?>
                </div>

                <script>
                    //  Close dropdown if clicked outside
                    window.addEventListener('click', function (e) {
                        const dropdown = document.getElementById('dropdown-menu');
                        if (!dropdown.contains(e.target) && !e.target.closest('button')) {
                            dropdown.classList.add('hidden');
                        }
                    });
                </script>



            </div>
        </div>
    </nav>

    <!-- Add padding to the top of our content to offset the fixed navbar -->
    <div class="pt-16">