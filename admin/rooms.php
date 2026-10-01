<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');

$rooms = new MockResult([
    ['room_number' => '101', 'category_name' => 'Shared Room', 'floor_number' => 1, 'capacity' => 2, 'base_rent' => 9000, 'total_beds' => 2, 'available_beds' => 1, 'occupied_beds' => 1],
    ['room_number' => '102', 'category_name' => 'Private Room', 'floor_number' => 1, 'capacity' => 1, 'base_rent' => 12500, 'total_beds' => 1, 'available_beds' => 0, 'occupied_beds' => 1],
    ['room_number' => '201', 'category_name' => 'Studio', 'floor_number' => 2, 'capacity' => 1, 'base_rent' => 14500, 'total_beds' => 1, 'available_beds' => 1, 'occupied_beds' => 0],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Room Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 40px; background: #f5f7fa; }
        .container { max-width: 1100px; margin: auto; }
        h1 { margin-bottom: 5px; }
        .welcome { color: #555; }
        .back-link { display: inline-block; margin: 20px 0; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .available { color: green; font-weight: bold; }
        .occupied { color: #b00020; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>HiveStay Room Management</h1>
    <p class="welcome">Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></p>
    <a class="back-link" href="../dashboard.php">← Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>Room</th>
                <th>Category</th>
                <th>Floor</th>
                <th>Capacity</th>
                <th>Base Rent</th>
                <th>Total Beds</th>
                <th>Available</th>
                <th>Occupied</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($room = $rooms->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($room['room_number']) ?></td>
                    <td><?= htmlspecialchars($room['category_name']) ?></td>
                    <td><?= htmlspecialchars($room['floor_number']) ?></td>
                    <td><?= htmlspecialchars($room['capacity']) ?></td>
                    <td>₱<?= number_format((float) $room['base_rent'], 2) ?></td>
                    <td><?= htmlspecialchars($room['total_beds']) ?></td>
                    <td class="available"><?= htmlspecialchars($room['available_beds'] ?? 0) ?></td>
                    <td class="occupied"><?= htmlspecialchars($room['occupied_beds'] ?? 0) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>