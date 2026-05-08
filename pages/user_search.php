<?php
require_once '../includes/db.php';

$q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$rows = [];
$error = '';

if ($q !== '') {
    $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $q);
    $like = '%' . $escaped . '%';
    try {
        $stmt = $conn->prepare(
            'SELECT id, first_name, last_name, email, home_address, home_phone, cell_phone
             FROM site_users
             WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR home_phone LIKE ? OR cell_phone LIKE ?'
        );
        if (!$stmt) {
            $error = 'Search unavailable. Confirm the site_users table exists on your host (see sql/install_site_users_infinityfree_phpMyAdmin.sql).';
        } else {
            $stmt->bind_param('sssss', $like, $like, $like, $like, $like);
            if (!$stmt->execute()) {
                $msg = trim((string) $stmt->error);
                $error = $msg !== ''
                    ? 'Search failed: ' . $msg
                    : 'Search failed (usually means table site_users is missing — run sql/install_site_users_infinityfree_phpMyAdmin.sql).';
            } else {
                $result = $stmt->get_result();
                if ($result instanceof mysqli_result) {
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                } else {
                    $error = 'Search could not read results — ask host to enable mysqlnd for PHP mysqli.';
                }
            }
            $stmt->close();
        }
    } catch (Throwable $e) {
        $error = 'Database error — run install_site_users_infinityfree_phpMyAdmin.sql in phpMyAdmin to create site_users.';
    }
}

include '../includes/header.php';
?>

<h2>Search users</h2>

<p><a href="/pages/users.php">← Back to Users</a></p>

<form class="user-form-card search-form-inline" method="get" action="">
    <label for="q">Search by name, email, or phone</label>
    <div class="search-row">
        <input id="q" name="q" type="search" maxlength="120" placeholder="e.g. Chen, gmail, 5550142"
               value="<?= htmlspecialchars($q) ?>">
        <button type="submit">Search</button>
    </div>
</form>

<?php if ($error !== ''): ?>
    <div class="form-message error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<?php if ($q === ''): ?>
    <p class="user-hub-muted">Enter a term above to search.</p>
<?php elseif (!$error && empty($rows)): ?>
    <p>No users matched <strong><?= htmlspecialchars($q) ?></strong>.</p>
<?php elseif (!$error): ?>

<table class="users-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Home address</th>
            <th>Home phone</th>
            <th>Cell phone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?></td>
                <td><?= htmlspecialchars((string) $r['email']) ?></td>
                <td><?= htmlspecialchars((string) $r['home_address']) ?></td>
                <td><?= htmlspecialchars((string) $r['home_phone']) ?></td>
                <td><?= htmlspecialchars((string) $r['cell_phone']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="user-hub-muted"><?= count($rows) ?> match<?= count($rows) === 1 ? '' : 'es' ?>.</p>

<?php endif; ?>

<?php include '../includes/footer.php'; ?>
