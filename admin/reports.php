<?php
session_start();
require_once '../mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');

$occupancy = new MockResult([
    ['room_number' => '101', 'floor_number' => 1, 'capacity' => 2, 'occupied_beds' => 1, 'occupancy_rate' => 50],
    ['room_number' => '102', 'floor_number' => 1, 'capacity' => 1, 'occupied_beds' => 1, 'occupancy_rate' => 100],
    ['room_number' => '201', 'floor_number' => 2, 'capacity' => 1, 'occupied_beds' => 0, 'occupancy_rate' => 0],
]);

$unpaid = new MockResult([
    ['bill_id' => 902, 'billing_period' => 'Aug 2026', 'resident_name' => 'Juan Dela Cruz', 'email' => 'juan@example.com', 'total_amount' => 3010.00, 'payment_status' => 'Unpaid'],
    ['bill_id' => 903, 'billing_period' => 'Aug 2026', 'resident_name' => 'Ana Reyes', 'email' => 'ana@example.com', 'total_amount' => 3490.00, 'payment_status' => 'Overdue'],
]);

$ranking = new MockResult([
    ['room_number' => '201', 'floor_number' => 2, 'total_utility' => 1235.00, 'utility_rank' => 1],
    ['room_number' => '101', 'floor_number' => 1, 'total_utility' => 990.00, 'utility_rank' => 2],
    ['room_number' => '102', 'floor_number' => 1, 'total_utility' => 820.00, 'utility_rank' => 3],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - Reports</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: 40px; font-family: Arial, sans-serif; background: #f5f7fa; }
        .container { max-width: 1200px; margin: auto; }
        h1 { margin-bottom: 5px; }
        h2 { margin-top: 40px; }
        .welcome { color: #555; }
        .back-link { display: inline-block; margin: 20px 0; text-decoration: none; color: #333; }
        .report-box { background: white; padding: 20px; border-radius: 8px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #333; color: white; }
        .paid { color: green; font-weight: bold; }
        .unpaid { color: #b36b00; font-weight: bold; }
        .overdue { color: #b00020; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>HiveStay Reports</h1>
    <p class="welcome">Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></p>
    <a class="back-link" href="../dashboard.php">← Back to Dashboard</a>

    <div class="report-box">
        <h2>Room Occupancy</h2>
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Floor</th>
                    <th>Capacity</th>
                    <th>Occupied</th>
                    <th>Occupancy Rate</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $occupancy->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['room_number']) ?></td>
                        <td><?= htmlspecialchars($item['floor_number']) ?></td>
                        <td><?= htmlspecialchars($item['capacity']) ?></td>
                        <td><?= htmlspecialchars($item['occupied_beds']) ?></td>
                        <td><?= htmlspecialchars($item['occupancy_rate']) ?>%</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="report-box">
        <h2>Unpaid / Overdue Invoices</h2>
        <table>
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Resident</th>
                    <th>Email</th>
                    <th>Billing Period</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($invoice = $unpaid->fetch_assoc()): ?>
                    <tr>
                        <td><?= (int) $invoice['bill_id'] ?></td>
                        <td><?= htmlspecialchars($invoice['resident_name']) ?></td>
                        <td><?= htmlspecialchars($invoice['email']) ?></td>
                        <td><?= htmlspecialchars($invoice['billing_period']) ?></td>
                        <td>₱<?= number_format((float) $invoice['total_amount'], 2) ?></td>
                        <td class="<?= strtolower($invoice['payment_status']) ?>"><?= htmlspecialchars($invoice['payment_status']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="report-box">
        <h2>Utility Consumption Ranking</h2>
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Floor</th>
                    <th>Total Utility</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($rank = $ranking->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($rank['room_number']) ?></td>
                        <td><?= htmlspecialchars($rank['floor_number']) ?></td>
                        <td>₱<?= number_format((float) $rank['total_utility'], 2) ?></td>
                        <td><?= htmlspecialchars($rank['utility_rank']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
</head>

<body>

<div class="container">

    <h1>HiveStay Reports</h1>

    <p class="welcome">
        Welcome,
        <?= htmlspecialchars($_SESSION["full_name"]) ?>
    </p>

    <a class="back-link" href="../dashboard.php">
        ← Back to Dashboard
    </a>


    <!-- =====================================================
         REPORT 1
         ===================================================== -->

    <h2>1. Room Occupancy Report</h2>

    <div class="report-box">

        <?php if ($occupancy->num_rows === 0): ?>

            <p>No room records found.</p>

        <?php else: ?>

            <table>

                <thead>

                    <tr>
                        <th>Room</th>
                        <th>Floor</th>
                        <th>Capacity</th>
                        <th>Total Beds</th>
                        <th>Occupied Beds</th>
                        <th>Occupancy Rate</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while ($room = $occupancy->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($room["room_number"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($room["floor_number"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($room["capacity"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($room["total_beds"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($room["occupied_beds"] ?? 0) ?>
                            </td>

                            <td>
                                <?= number_format(
                                    (float) $room["occupancy_rate"],
                                    2
                                ) ?>%
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </div>


    <!-- =====================================================
         REPORT 2
         ===================================================== -->

    <h2>2. Unpaid / Overdue Invoice Report</h2>

    <div class="report-box">

        <?php if ($unpaid->num_rows === 0): ?>

            <p>No unpaid or overdue invoices found.</p>

        <?php else: ?>

            <table>

                <thead>

                    <tr>
                        <th>Bill ID</th>
                        <th>Resident</th>
                        <th>Room</th>
                        <th>Billing Period</th>
                        <th>Electric</th>
                        <th>Water</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while ($bill = $unpaid->fetch_assoc()): ?>

                        <?php

                        $room_stmt = $conn->prepare("
                            SELECT r.room_number
                            FROM lease_agreements la
                            INNER JOIN beds b
                                ON la.bed_id = b.bed_id
                            INNER JOIN rooms r
                                ON b.room_id = r.room_id
                            WHERE la.lease_id = ?
                        ");

                        $room_stmt->bind_param(
                            "i",
                            $bill["lease_id"]
                        );

                        $room_stmt->execute();

                        $room_result = $room_stmt->get_result();

                        $room_number = "N/A";

                        if ($room_result->num_rows === 1) {
                            $room_row = $room_result->fetch_assoc();
                            $room_number = $room_row["room_number"];
                        }

                        $room_stmt->close();

                        ?>

                        <tr>

                            <td>
                                <?= (int) $bill["bill_id"] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($bill["resident_name"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($room_number) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($bill["billing_period"]) ?>
                            </td>

                            <td>
                                ₱<?= number_format(
                                    (float) $bill["electric_share"],
                                    2
                                ) ?>
                            </td>

                            <td>
                                ₱<?= number_format(
                                    (float) $bill["water_share"],
                                    2
                                ) ?>
                            </td>

                            <td>
                                ₱<?= number_format(
                                    (float) $bill["total_amount"],
                                    2
                                ) ?>
                            </td>

                            <td class="<?= strtolower($bill["payment_status"]) ?>">
                                <?= htmlspecialchars($bill["payment_status"]) ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </div>


    <!-- =====================================================
         REPORT 3
         ===================================================== -->

    <h2>3. Utility Consumption Ranking</h2>

    <div class="report-box">

        <p>
            Rooms are ranked by total recorded utility charges
            within each floor.
        </p>

        <?php if ($ranking->num_rows === 0): ?>

            <p>No utility records found.</p>

        <?php else: ?>

            <table>

                <thead>

                    <tr>
                        <th>Room</th>
                        <th>Floor</th>
                        <th>Total Utility</th>
                        <th>Rank</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while ($row = $ranking->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($row["room_number"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["floor_number"]) ?>
                            </td>

                            <td>
                                ₱<?= number_format(
                                    (float) $row["total_utility"],
                                    2
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["utility_rank"]) ?>
                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </div>

</div>

</body>

</html>