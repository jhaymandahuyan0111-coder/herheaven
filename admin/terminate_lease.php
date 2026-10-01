<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');
$lease_id = isset($_GET['lease_id']) ? (int) $_GET['lease_id'] : 301;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Lease Mockup</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Lease Termination Preview</h1>
        <p><strong>Lease ID:</strong> <?= (int) $lease_id ?></p>
        <p><strong>Status:</strong> <span class="badge badge-maintenance">Mockup mode</span></p>
        <p>This is a front-end mockup only. Authentication and lease termination logic are disabled for page review.</p>
        <a class="btn" href="leases.php">Back to Lease Management</a>
    </div>
</div>
</body>
</html>