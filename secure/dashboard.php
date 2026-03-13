<?php
include '../includes/auth.php';
check_auth();
?>

<?php include '../includes/header.php'; ?>

<h2>Admin Dashboard</h2>

<p>Welcome, Administrator. Manage your HaloVoyage website from here.</p>

<div class="admin-stats">

<div class="admin-card">
<h3>Total Users</h3>
<p>
<?php
$users = file("../data/users.txt");
echo count($users);
?>
</p>
</div>

<div class="admin-card">
<h3>Website Status</h3>
<p>Online</p>
</div>

<div class="admin-card">
<h3>Admin Role</h3>
<p>Super Admin</p>
</div>

</div>

<h3>Registered Users</h3>

<table class="users-table">

<tr>
<th>#</th>
<th>Name</th>
</tr>

<?php
$file = fopen("../data/users.txt","r");
$count = 1;

while(($line = fgets($file)) !== false){

echo "<tr>";
echo "<td>".$count."</td>";
echo "<td>".htmlspecialchars(trim($line))."</td>";
echo "</tr>";

$count++;
}

fclose($file);
?>

</table>

<div class="admin-actions">

<a href="../index.php" class="admin-btn">View Website</a> <a href="logout.php" class="admin-btn logout-btn">Logout</a>

</div>

<?php include '../includes/footer.php'; ?>
