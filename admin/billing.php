<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');

$bills = new MockResult([
    ['bill_id' => 901, 'resident_name' => 'Maria Santos', 'room_number' => '101', 'bed_number' => 'B1', 'billing_period' => 'Aug 2026', 'electric_share' => 650.00, 'water_share' => 180.00, 'total_amount' => 2830.00, 'payment_status' => 'Paid'],
    ['bill_id' => 902, 'resident_name' => 'Juan Dela Cruz', 'room_number' => '102', 'bed_number' => 'B2', 'billing_period' => 'Aug 2026', 'electric_share' => 720.00, 'water_share' => 190.00, 'total_amount' => 3010.00, 'payment_status' => 'Unpaid'],
    ['bill_id' => 903, 'resident_name' => 'Ana Reyes', 'room_number' => '201', 'bed_number' => 'A1', 'billing_period' => 'Aug 2026', 'electric_share' => 780.00, 'water_share' => 210.00, 'total_amount' => 3490.00, 'payment_status' => 'Overdue'],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Billing Management</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 40px; font-family: Arial, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: auto; }
        .back-link { display: inline-block; margin: 20px 0; text-decoration: none; color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .paid { color: green; font-weight: bold; }
        .unpaid { color: #b36b00; font-weight: bold; }
        .overdue { color: #b00020; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>HiveStay Billing Management</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></p>
    <a class="back-link" href="../dashboard.php">← Back to Dashboard</a>
    <table>
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Resident</th>
                <th>Room</th>
                <th>Bed</th>
                <th>Billing Period</th>
                <th>Electric</th>
                <th>Water</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($bill = $bills->fetch_assoc()): ?>
                <tr>
                    <td><?= (int) $bill['bill_id'] ?></td>
                    <td><?= htmlspecialchars($bill['resident_name']) ?></td>
                    <td><?= htmlspecialchars($bill['room_number']) ?></td>
                    <td><?= htmlspecialchars($bill['bed_number']) ?></td>
                    <td><?= htmlspecialchars($bill['billing_period']) ?></td>
                    <td>₱<?= number_format((float) $bill['electric_share'], 2) ?></td>
                    <td>₱<?= number_format((float) $bill['water_share'], 2) ?></td>
                    <td>₱<?= number_format((float) $bill['total_amount'], 2) ?></td>
                    <td class="<?= strtolower($bill['payment_status']) ?>"><?= htmlspecialchars($bill['payment_status']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
