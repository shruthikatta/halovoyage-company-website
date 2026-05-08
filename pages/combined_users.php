<?php include '../includes/header.php'; ?>
<?php include '../includes/api_client.php'; ?>

<h2>Combined Users</h2>

<?php
// =====================
// Company A (LOCAL DB)
// =====================
include '../includes/db.php';

$users_A = [];

$result = $conn->query("SELECT full_name, email, role, company_name FROM users");

if (!$result) {
    die("Query failed: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    $users_A[] = $row;
}

// =====================
// Company B (REMOTE API)
// =====================
$companyB_url = "https://shirishagujja.me/api/users.php";
$users_B = fetch_remote_users($companyB_url);

// =====================
// Safety checks
// =====================
if (!is_array($users_A)) $users_A = [];
if (!is_array($users_B)) $users_B = [];

// =====================
// Combine both sources
// =====================
$all_users = array_merge($users_A, $users_B);
?>

<?php if (empty($all_users)): ?>
    <p>No users available.</p>
<?php else: ?>

<table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Company</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_users as $user): ?>
            <tr>
                <td>
                    <?php 
                    echo htmlspecialchars(
                        $user['name'] ?? $user['full_name'] ?? 'N/A'
                    ); 
                    ?>
                </td>
                <td>
                    <?php 
                    echo htmlspecialchars($user['email'] ?? 'N/A'); 
                    ?>
                </td>
                <td>
                    <?php 
                    echo htmlspecialchars($user['role'] ?? 'N/A'); 
                    ?>
                </td>
                <td>
                    <?php 
                    echo htmlspecialchars(
                        $user['company'] ?? $user['company_name'] ?? 'N/A'
                    ); 
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>

<?php include '../includes/footer.php'; ?>
