<?php include '../includes/header.php'; ?>

<h2>Users</h2>
<p>Use the links below to add a new user or search existing users stored in our database.</p>

<div class="card-container user-hub-cards">
    <div class="card user-hub-card">
        <h3>Create user</h3>
        <p>Enter first name, last name, email, address, and phone numbers.</p>
        <a class="btn" href="/pages/user_create.php">Open create form</a>
    </div>
    <div class="card user-hub-card">
        <h3>Search users</h3>
        <p>Search by name fragments, email, or phone (home or mobile).</p>
        <a class="btn" href="/pages/user_search.php">Open search form</a>
    </div>
</div>

<p class="user-hub-muted">For combined listings with partner data: <a href="/pages/combined_users.php">All users (combined)</a></p>

<?php include '../includes/footer.php'; ?>
