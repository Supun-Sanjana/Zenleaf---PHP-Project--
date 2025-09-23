<?php include './header.php' ?>

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

<div class="bg-gray-800 p-8 rounded-lg shadow-xl">
    <h2 class="text-3xl font-bold text-emerald-400 mb-6">Supplier Information 🚚</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="py-3.5 px-4 text-left text-sm font-semibold text-gray-300">Supplier Name</th>
                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">Contact Person</th>
                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">Email</th>
                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">City</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 bg-gray-800">
                <tr>
                    <td class="px-4 py-4 text-sm font-medium text-gray-200">Green Thumb Nursery</td>
                    <td class="px-4 py-4 text-sm text-gray-400">Jane Doe</td>
                    <td class="px-4 py-4 text-sm text-gray-400">jane.doe@greenthumb.com</td>
                    <td class="px-4 py-4 text-sm text-gray-400">Los Angeles</td>
                </tr>
                <tr>
                    <td class="px-4 py-4 text-sm font-medium text-gray-200">Tropical Imports Inc.</td>
                    <td class="px-4 py-4 text-sm text-gray-400">John Smith</td>
                    <td class="px-4 py-4 text-sm text-gray-400">john.smith@tropical.com</td>
                    <td class="px-4 py-4 text-sm text-gray-400">Miami</td>
                </tr>
                <tr>
                    <td class="px-4 py-4 text-sm font-medium text-gray-200">Eco-Grow Supplies</td>
                    <td class="px-4 py-4 text-sm text-gray-400">Alex Chen</td>
                    <td class="px-4 py-4 text-sm text-gray-400">alex.c@ecogrow.net</td>
                    <td class="px-4 py-4 text-sm text-gray-400">Seattle</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>