<?php
session_start();

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $password_hash = md5($password);

    $file = fopen("../data/admin.txt","r");
    $line = fgets($file);
    fclose($file);

    list($stored_user, $stored_hash) = explode(":", trim($line));

    if($username == $stored_user && $password_hash == $stored_hash){

        $_SESSION["admin_logged_in"] = true;

        header("Location: dashboard.php");
        exit();

    } else {

        $error = "Invalid login credentials";

    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="login-container">
<div class="login-card">

<h2>Admin Login</h2>

<form method="post">

<label>Username</label> <input type="text" name="username" required>

<label>Password</label> <input type="password" name="password" required>

<button type="submit">Login</button>

</form>

<p class="login-error"><?php echo $error; ?></p>

</div>
</div>

<?php include '../includes/footer.php'; ?>
