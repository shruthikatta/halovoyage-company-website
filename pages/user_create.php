<?php
require_once '../includes/db.php';

$errors = [];
$success = '';
$post = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim((string) ($_POST['first_name'] ?? ''));
    $last_name = trim((string) ($_POST['last_name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $home_address = trim((string) ($_POST['home_address'] ?? ''));
    $home_phone = trim((string) ($_POST['home_phone'] ?? ''));
    $cell_phone = trim((string) ($_POST['cell_phone'] ?? ''));
    $post = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'home_address' => $home_address,
        'home_phone' => $home_phone,
        'cell_phone' => $cell_phone,
    ];

    if ($first_name === '') {
        $errors[] = 'First name is required.';
    }
    if ($last_name === '') {
        $errors[] = 'Last name is required.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    if ($home_address === '') {
        $errors[] = 'Home address is required.';
    }
    if ($home_phone === '') {
        $errors[] = 'Home phone is required.';
    }
    if ($cell_phone === '') {
        $errors[] = 'Cell phone is required.';
    }

    if (!$errors) {
        try {
            $stmt = $conn->prepare(
                'INSERT INTO site_users (first_name, last_name, email, home_address, home_phone, cell_phone) VALUES (?, ?, ?, ?, ?, ?)'
            );
            if (!$stmt) {
                $errors[] = 'Unable to prepare statement.';
            } else {
                $stmt->bind_param(
                    'ssssss',
                    $first_name,
                    $last_name,
                    $email,
                    $home_address,
                    $home_phone,
                    $cell_phone
                );
                try {
                    if ($stmt->execute()) {
                        $success = 'User created successfully.';
                        $post = [];
                    } elseif ($conn->errno === 1062) {
                        $errors[] = 'That email is already registered.';
                    } else {
                        $errors[] = 'Could not save user. Confirm the site_users table exists.';
                    }
                } catch (Throwable $e) {
                    if ($conn->errno === 1062 || (isset($stmt->errno) && $stmt->errno === 1062)) {
                        $errors[] = 'That email is already registered.';
                    } else {
                        $errors[] = 'Database error — create table site_users in phpMyAdmin (sql/install_site_users_infinityfree_phpMyAdmin.sql).';
                    }
                }
                $stmt->close();
            }
        } catch (Throwable $e) {
            $errors[] = 'Database error — create table site_users in phpMyAdmin (sql/install_site_users_infinityfree_phpMyAdmin.sql).';
        }
    }
}

include '../includes/header.php';
?>

<h2>Create user</h2>

<p><a href="/pages/users.php">← Back to Users</a></p>

<?php if ($success !== ''): ?>
    <div class="form-message success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($errors): ?>
    <div class="form-message error">
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form class="user-form-card" method="post" action="">
    <label for="first_name">First name</label>
    <input id="first_name" name="first_name" required maxlength="80"
           value="<?= htmlspecialchars((string) ($post['first_name'] ?? '')) ?>">

    <label for="last_name">Last name</label>
    <input id="last_name" name="last_name" required maxlength="80"
           value="<?= htmlspecialchars((string) ($post['last_name'] ?? '')) ?>">

    <label for="email">Email</label>
    <input id="email" name="email" type="email" required maxlength="255"
           value="<?= htmlspecialchars((string) ($post['email'] ?? '')) ?>">

    <label for="home_address">Home address</label>
    <textarea id="home_address" name="home_address" rows="3" required maxlength="500"><?= htmlspecialchars((string) ($post['home_address'] ?? '')) ?></textarea>

    <label for="home_phone">Home phone</label>
    <input id="home_phone" name="home_phone" required maxlength="40"
           value="<?= htmlspecialchars((string) ($post['home_phone'] ?? '')) ?>">

    <label for="cell_phone">Cell phone</label>
    <input id="cell_phone" name="cell_phone" required maxlength="40"
           value="<?= htmlspecialchars((string) ($post['cell_phone'] ?? '')) ?>">

    <button type="submit">Create user</button>
</form>

<?php include '../includes/footer.php'; ?>
