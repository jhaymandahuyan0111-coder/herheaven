<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');

$beds = new MockResult([
    ['bed_id' => 101, 'bed_number' => 'B1', 'room_number' => '101', 'category_name' => 'Shared Room', 'floor_number' => 1, 'status' => 'Available'],
    ['bed_id' => 102, 'bed_number' => 'B2', 'room_number' => '102', 'category_name' => 'Private Room', 'floor_number' => 1, 'status' => 'Occupied'],
    ['bed_id' => 201, 'bed_number' => 'A1', 'room_number' => '201', 'category_name' => 'Studio', 'floor_number' => 2, 'status' => 'Available'],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Bed Management</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 40px; font-family: Arial, sans-serif; background: #f5f7fa; }
        .container { max-width: 1000px; margin: auto; }
        h1 { margin-bottom: 5px; }
        .welcome { color: #555; }
        .back-link { display: inline-block; margin: 20px 0; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .available { color: green; font-weight: bold; }
        .occupied { color: #b00020; font-weight: bold; }
        .maintenance { color: #b36b00; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>HiveStay Bed Management</h1>
    <p class="welcome">Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></p>
    <a class="back-link" href="../dashboard.php">← Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>Bed ID</th>
                <th>Bed Number</th>
                <th>Room</th>
                <th>Category</th>
                <th>Floor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($bed = $beds->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($bed['bed_id']) ?></td>
                    <td><?= htmlspecialchars($bed['bed_number']) ?></td>
                    <td><?= htmlspecialchars($bed['room_number']) ?></td>
                    <td><?= htmlspecialchars($bed['category_name']) ?></td>
                    <td><?= htmlspecialchars($bed['floor_number']) ?></td>
                    <td class="<?= strtolower($bed['status']) ?>"><?= htmlspecialchars($bed['status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>