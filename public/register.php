<!-- Customer registration -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/register.css">
   
</head>
<body>

<div class="bg-white rounded-2xl w-full max-w-md overflow-hidden transition-all duration-300 shadow-xl">

    <!-- Header -->
    <div class="bg-gradient-to-r from-[#00a8a3] to-[#8582f4] px-8 py-10 text-center">
        <h1 class="text-2xl font-bold text-white mb-2">Create Your Account</h1>
        <p class="text-[#a0f0ed] text-sm">Join ZenLeaf today and get started</p>
    </div>

    <!-- Form -->
    <form method="POST" action="register.php" class="p-8 space-y-6">
        <!-- CSRF Token, a security feature for forms. -->
        <input type="hidden" name="_token" value="your_csrf_token_here">

        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
            <input id="first_name" type="text" name="first_name" value="" required autocomplete="first_name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#00a8a3] focus:border-transparent transition-all duration-200"
                placeholder="John">
        </div>

        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
            <input id="last_name" type="text" name="last_name"  value="" required autocomplete="last_name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#00a8a3] focus:border-transparent transition-all duration-200"
                placeholder="Doe">

        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
            <input id="email" type="email" name="email" value="" required autocomplete="username"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#00a8a3] focus:border-transparent transition-all duration-200"
                placeholder="you@example.com">

        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Register As</label>
            <div class="flex items-center gap-6 mt-2">
                <label class="flex items-center">
                    <input type="radio" name="type" value="customer" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded-full" >
                    <span class="ml-2 text-gray-700">Customer</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="type" value="seller" class="text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded-full" >
                    <span class="ml-2 text-gray-700">Seller</span>
                </label>
            </div>

        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#00a8a3] focus:border-transparent transition-all duration-200"
                placeholder="••••••••">

        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#00a8a3] focus:border-transparent transition-all duration-200"
                placeholder="••••••••">

        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between">
            <a href="#" class="text-sm font-medium text-[#00a8a3] hover:text-[#00b6af] transition-colors duration-200">
                Already registered?
            </a>
            <button type="submit"
                class="bg-gradient-to-r from-[#00a8a3] to-[#8582f4] text-white py-3 px-6 rounded-lg font-medium hover:from-[#00b6af] hover:to-[#9a92f6] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#00a8a3] transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg">
                Register
            </button>
        </div>
    </form>
</div>

</body>
</html>
