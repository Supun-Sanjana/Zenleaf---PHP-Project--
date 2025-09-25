<?php
include("../../lib/database.php");
include("../../backend/admin/admin_auth.php");

checkAdmin(); // Ensure admin is logged in

// Toggle Approve/Disapprove
if (isset($_POST['toggle_approve']) && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $res = mysqli_query($con, "SELECT approve FROM users WHERE user_id='$user_id' AND type='supplier'");
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $newStatus = $row['approve'] ? 0 : 1;
        mysqli_query($con, "UPDATE users SET approve='$newStatus' WHERE user_id='$user_id'");
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
// Fetch suppliers + business reg
function fetchSuppliers($con)
{
    $suppliers = [];
    $sql = "SELECT u.user_id, u.first_name, u.user_name, u.email, u.approve,
                   b.b_certificate
            FROM users u
            LEFT JOIN business_reg b ON u.user_id = b.user_id
            WHERE u.type='supplier'
            ORDER BY u.id DESC";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $suppliers[] = $row;
        }
    }
    return $suppliers;
}

$suppliers = fetchSuppliers($con);
?>
<?php include './header.php'; ?>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    crossorigin="anonymous" />

<div class="bg-gray-800 min-h-screen p-6">
    <div class="bg-gray-900 p-8 shadow-xl rounded-xl">
        <h2 class="text-3xl font-bold text-emerald-400 mb-6">Supplier Management 🚚</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="py-3.5 px-4 text-left text-sm font-semibold text-gray-300">First Name</th>
                        <th class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">User Name</th>
                        <th class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">Email</th>
                        <th class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">Approve</th>
                        <th class="px-4 py-3.5 text-left text-sm font-semibold text-gray-300">Business Registration</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 bg-gray-800">
                    <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $supplier): ?>
                            <tr>
                                <td class="px-4 py-4 text-sm font-medium text-gray-200">
                                    <?= htmlspecialchars($supplier['first_name']) ?>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400">
                                    <?= htmlspecialchars($supplier['user_name']) ?>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400">
                                    <?= htmlspecialchars($supplier['email']) ?>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400">
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?= $supplier['user_id'] ?>">
                                        <?php if ($supplier['approve']): ?>
                                            <button type="submit" name="toggle_approve"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                                Disapprove
                                            </button>
                                        <?php else: ?>
                                            <button type="submit" name="toggle_approve"
                                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                                Approve
                                            </button>
                                        <?php endif; ?>
                                    </form>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-400">
                                    <?php if (!empty($supplier['b_certificate'])): ?>
                                        <button onclick="openBRModal('<?= htmlspecialchars($supplier['b_certificate']) ?>')"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                            Preview BR
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-500 text-xs">Not uploaded</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-400">No suppliers found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="brModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-3/4 max-w-3xl p-4 relative">
        <button onclick="closeBRModal()"
            class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-xl">&times;</button>
        <iframe id="brFrame" src="<?= htmlspecialchars($supplier['b_certificate']) ?>"
            class="w-full h-96 rounded-lg border"></iframe>
    </div>
</div>


<script>
    function openBRModal(filePath) {
        document.getElementById('brFrame').src = filePath;
        document.getElementById('brModal').classList.remove('hidden');
    }
    function closeBRModal() {
        document.getElementById('brFrame').src = '';
        document.getElementById('brModal').classList.add('hidden');
    }
</script>