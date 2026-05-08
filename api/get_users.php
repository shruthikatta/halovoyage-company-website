<?php
header('Content-Type: application/json');

include '../includes/db.php';

$users = [];

$result = $conn->query("SELECT full_name, email, role, company_name FROM users");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode($users);
?>