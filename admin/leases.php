<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');

$leases = new MockResult([
    ['lease_id' => 301, 'resident_name' => 'Maria Santos', 'resident_email' => 'maria@example.com', 'room_number' => '101', 'bed_number' => 'B1', 'category_name' => 'Shared Room', 'start_date' => '2026-08-01', 'end_date' => '2027-08-01', 'lease_status' => 'Active'],
    ['lease_id' => 302, 'resident_name' => 'Juan Dela Cruz', 'resident_email' => 'juan@example.com', 'room_number' => '102', 'bed_number' => 'B2', 'category_name' => 'Private Room', 'start_date' => '2026-08-10', 'end_date' => '2027-08-10', 'lease_status' => 'Pending'],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Lease Management</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 40px; font-family: Arial, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: auto; }
        h1 { margin-bottom: 5px; }
        .welcome { color: #555; }
        .back-link { display: inline-block; margin: 20px 0; text-decoration: none; color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .active { color: green; font-weight: bold; }
        .pending { color: #b36b00; font-weight: bold; }
        .terminated { color: #b00020; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>HiveStay Lease Management</h1>
    <p class="welcome">Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></p>
    <a class="back-link" href="../dashboard.php">← Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>Lease ID</th>
                <th>Resident</th>
                <th>Email</th>
                <th>Room</th>
                <th>Bed</th>
                <th>Category</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($lease = $leases->fetch_assoc()): ?>
                <tr>
                    <td><?= (int) $lease['lease_id'] ?></td>
                    <td><?= htmlspecialchars($lease['resident_name']) ?></td>
                    <td><?= htmlspecialchars($lease['resident_email']) ?></td>
                    <td><?= htmlspecialchars($lease['room_number']) ?></td>
                    <td><?= htmlspecialchars($lease['bed_number']) ?></td>
                    <td><?= htmlspecialchars($lease['category_name']) ?></td>
                    <td><?= htmlspecialchars($lease['start_date']) ?></td>
                    <td><?= htmlspecialchars($lease['end_date']) ?></td>
                    <td class="<?= strtolower($lease['lease_status']) ?>"><?= htmlspecialchars($lease['lease_status']) ?></td>
                    <td><a href="terminate_lease.php">View</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
