<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Resident', 'Demo Resident');

$bed_id = isset($_GET['bed_id']) ? (int) $_GET['bed_id'] : 101;
$bed = ['bed_id' => $bed_id, 'bed_number' => 'B2', 'status' => 'Available', 'room_number' => '102', 'floor_number' => 1, 'capacity' => 2, 'base_rent' => 12500, 'category_name' => 'Premium Room'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Confirm Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar">
    <span class="brand">HiveStay</span>
    <a href="resident_dashboard.php">Dashboard</a>
    <a href="book_bed.php">Available Beds</a>
    <a href="my_lease.php">My Lease</a>
    <a href="my_bills.php">My Bills</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
    <div class="card">
        <h1>Confirm Bed Booking</h1>
        <p>Review the selected bed before confirming your reservation.</p>
    </div>

    <div class="card">
        <h2><?= htmlspecialchars($bed['bed_number']) ?></h2>
        <p><strong>Room:</strong> <?= htmlspecialchars($bed['room_number']) ?></p>
        <p><strong>Floor:</strong> <?= htmlspecialchars($bed['floor_number']) ?></p>
        <p><strong>Category:</strong> <?= htmlspecialchars($bed['category_name']) ?></p>
        <p><strong>Monthly Rent:</strong> ₱<?= number_format((float) $bed['base_rent'], 2) ?></p>
        <p><strong>Status:</strong> <span class="badge badge-available"><?= htmlspecialchars($bed['status']) ?></span></p>

        <form method="GET" action="resident_dashboard.php">
            <button type="submit" class="btn">Confirm Booking</button>
        </form>
    </div>
</div>
</body>
</html>