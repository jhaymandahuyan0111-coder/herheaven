<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Resident', 'Demo Resident');

$mockBeds = [
    ['bed_id' => 101, 'bed_number' => 'B1', 'status' => 'Available', 'room_number' => '101', 'floor_number' => 1, 'capacity' => 2, 'base_rent' => 12500, 'category_name' => 'Private Room'],
    ['bed_id' => 102, 'bed_number' => 'B2', 'status' => 'Available', 'room_number' => '102', 'floor_number' => 1, 'capacity' => 2, 'base_rent' => 11800, 'category_name' => 'Shared Room'],
    ['bed_id' => 201, 'bed_number' => 'A1', 'status' => 'Available', 'room_number' => '201', 'floor_number' => 2, 'capacity' => 1, 'base_rent' => 14500, 'category_name' => 'Studio'],
    ['bed_id' => 203, 'bed_number' => 'A3', 'status' => 'Occupied', 'room_number' => '203', 'floor_number' => 2, 'capacity' => 1, 'base_rent' => 15500, 'category_name' => 'Studio'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Available Beds</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <span class="brand">HiveStay</span>
        <a href="resident_dashboard.php">Dashboard</a>
        <a href="book_bed.php">Available Beds</a>
        <a href="my_bills.php">My Bills</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="card">
            <h1>Available Beds</h1>
            <p>Welcome, <strong><?= htmlspecialchars($_SESSION['full_name']) ?></strong></p>
            <p>Browse currently open bed spaces and choose the best fit for your stay.</p>
        </div>

        <div class="dashboard-grid">
            <?php foreach ($mockBeds as $bed): ?>
                <div class="module-card">
                    <h3><?= htmlspecialchars($bed['category_name']) ?></h3>
                    <p><strong>Room:</strong> <?= htmlspecialchars($bed['room_number']) ?> | <strong>Bed:</strong> <?= htmlspecialchars($bed['bed_number']) ?></p>
                    <p><strong>Floor:</strong> <?= htmlspecialchars($bed['floor_number']) ?> | <strong>Capacity:</strong> <?= htmlspecialchars($bed['capacity']) ?></p>
                    <p><strong>Status:</strong> <span class="badge badge-available"><?= htmlspecialchars($bed['status']) ?></span></p>
                    <p><strong>Monthly Rent:</strong> ₱<?= number_format((float) $bed['base_rent'], 2) ?></p>
                    <a class="btn" href="confirm_booking.php?bed_id=<?= (int) $bed['bed_id'] ?>">Book This Bed</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
                    <?= htmlspecialchars($_SESSION["full_name"]) ?>
                </strong>
            </p>

            <p>
                Select an available bed to continue with your reservation.
            </p>

        </div>


        <?php if ($beds->num_rows === 0): ?>

            <div class="card">

                <div class="alert alert-error">

                    No beds are currently available.

                </div>

                <a
                    class="btn"
                    href="resident_dashboard.php"
                >
                    Back to Dashboard
                </a>

            </div>

        <?php else: ?>


            <div class="card">

                <table>

                    <thead>

                        <tr>

                            <th>Bed</th>
                            <th>Room</th>
                            <th>Category</th>
                            <th>Floor</th>
                            <th>Capacity</th>
                            <th>Monthly Rent</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($bed = $beds->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars(
                                        $bed["bed_number"]
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $bed["room_number"]
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $bed["category_name"]
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $bed["floor_number"]
                                    ) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $bed["capacity"]
                                    ) ?>
                                </td>

                                <td>
                                    ₱<?= number_format(
                                        (float) $bed["base_rent"],
                                        2
                                    ) ?>
                                </td>

                                <td>

                                    <span class="badge badge-available">
                                        <?= htmlspecialchars(
                                            $bed["status"]
                                        ) ?>
                                    </span>

                                </td>

                                <td>

                                    <a
                                        class="btn"
                                        href="confirm_booking.php?bed_id=<?= (int) $bed["bed_id"] ?>"
                                    >
                                        Book This Bed
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>