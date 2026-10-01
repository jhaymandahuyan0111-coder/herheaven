<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Resident', 'Demo Resident');

$lease = [
    'lease_id' => 201,
    'lease_status' => 'Active',
    'start_date' => '2026-08-01',
    'end_date' => '2027-08-01',
    'room_number' => '102',
    'bed_number' => 'B2',
    'category_name' => 'Premium Room',
    'floor_number' => 1,
    'capacity' => 2,
    'base_rent' => 12500,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - My Lease</title>
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
        <h1>My Lease</h1>
        <p>Welcome, <strong><?= htmlspecialchars($_SESSION['full_name']) ?></strong></p>
    </div>

    <div class="card">
        <h2>Lease Information</h2>
        <p><strong>Lease ID:</strong> <?= (int) $lease['lease_id'] ?></p>
        <p><strong>Status:</strong> <span class="badge badge-available"><?= htmlspecialchars($lease['lease_status']) ?></span></p>
        <p><strong>Start Date:</strong> <?= htmlspecialchars($lease['start_date']) ?></p>
        <p><strong>End Date:</strong> <?= htmlspecialchars($lease['end_date']) ?></p>
    </div>

    <div class="card">
        <h2>Accommodation</h2>
        <p><strong>Room:</strong> <?= htmlspecialchars($lease['room_number']) ?></p>
        <p><strong>Bed:</strong> <?= htmlspecialchars($lease['bed_number']) ?></p>
        <p><strong>Category:</strong> <?= htmlspecialchars($lease['category_name']) ?></p>
        <p><strong>Floor:</strong> <?= htmlspecialchars($lease['floor_number']) ?></p>
        <p><strong>Capacity:</strong> <?= htmlspecialchars($lease['capacity']) ?></p>
        <p><strong>Monthly Rent:</strong> ₱<?= number_format((float) $lease['base_rent'], 2) ?></p>
    </div>
</div>
</body>
</html>
        <h1>My Lease</h1>

        <p>
            Welcome,
            <strong>
                <?= htmlspecialchars($_SESSION["full_name"]) ?>
            </strong>
        </p>

    </div>

    <?php if ($lease === null): ?>

        <div class="card">

            <div class="alert alert-error">
                You currently have no lease record.
            </div>

            <a
                class="btn"
                href="book_bed.php"
            >
                Browse Available Beds
            </a>

        </div>

    <?php else: ?>

        <div class="card">

            <h2>Lease Information</h2>

            <p>
                <strong>Lease ID:</strong>
                <?= (int) $lease["lease_id"] ?>
            </p>

            <p>
                <strong>Status:</strong>

                <?php if ($lease["lease_status"] === "Active"): ?>

                    <span class="badge badge-available">
                        Active
                    </span>

                <?php elseif ($lease["lease_status"] === "Pending"): ?>

                    <span class="badge badge-maintenance">
                        Pending
                    </span>

                <?php else: ?>

                    <span class="badge badge-occupied">
                        Terminated
                    </span>

                <?php endif; ?>

            </p>

            <p>
                <strong>Start Date:</strong>
                <?= htmlspecialchars($lease["start_date"]) ?>
            </p>

            <p>
                <strong>End Date:</strong>

                <?php if (!empty($lease["end_date"])): ?>

                    <?= htmlspecialchars($lease["end_date"]) ?>

                <?php else: ?>

                    No fixed end date

                <?php endif; ?>

            </p>

        </div>

        <div class="card">

            <h2>Accommodation</h2>

            <p>
                <strong>Room:</strong>
                <?= htmlspecialchars($lease["room_number"]) ?>
            </p>

            <p>
                <strong>Bed:</strong>
                <?= htmlspecialchars($lease["bed_number"]) ?>
            </p>

            <p>
                <strong>Category:</strong>
                <?= htmlspecialchars($lease["category_name"]) ?>
            </p>

            <p>
                <strong>Floor:</strong>
                <?= htmlspecialchars($lease["floor_number"]) ?>
            </p>

            <p>
                <strong>Capacity:</strong>
                <?= htmlspecialchars($lease["capacity"]) ?>
            </p>

            <p>
                <strong>Monthly Rent:</strong>
                ₱<?= number_format(
                    (float) $lease["base_rent"],
                    2
                ) ?>
            </p>

        </div>

    <?php endif; ?>

</div>

</body>

</html>