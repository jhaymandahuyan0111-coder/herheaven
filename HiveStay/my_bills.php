<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Resident', 'Demo Resident');

$bills = new MockResult([
    ['bill_id' => 101, 'billing_period' => 'Aug 2026', 'room_number' => '102', 'bed_number' => 'B2', 'electric_share' => 650.00, 'water_share' => 180.00, 'total_amount' => 2900.00, 'payment_status' => 'Unpaid'],
    ['bill_id' => 102, 'billing_period' => 'Sep 2026', 'room_number' => '102', 'bed_number' => 'B2', 'electric_share' => 610.00, 'water_share' => 175.00, 'total_amount' => 2785.00, 'payment_status' => 'Paid'],
    ['bill_id' => 103, 'billing_period' => 'Oct 2026', 'room_number' => '102', 'bed_number' => 'B2', 'electric_share' => 720.00, 'water_share' => 190.00, 'total_amount' => 3010.00, 'payment_status' => 'Overdue'],
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay - My Bills</title>
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
        <h1>My Bills</h1>
        <p>Resident: <strong><?= htmlspecialchars($_SESSION['full_name']) ?></strong></p>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Billing Period</th>
                    <th>Room</th>
                    <th>Bed</th>
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
                        <td><?= htmlspecialchars($bill['billing_period']) ?></td>
                        <td><?= htmlspecialchars($bill['room_number']) ?></td>
                        <td><?= htmlspecialchars($bill['bed_number']) ?></td>
                        <td>₱<?= number_format((float) $bill['electric_share'], 2) ?></td>
                        <td>₱<?= number_format((float) $bill['water_share'], 2) ?></td>
                        <td>₱<?= number_format((float) $bill['total_amount'], 2) ?></td>
                        <td>
                            <?php if ($bill['payment_status'] === 'Paid'): ?>
                                <span class="badge badge-available">Paid</span>
                            <?php elseif ($bill['payment_status'] === 'Overdue'): ?>
                                <span class="badge badge-occupied">Overdue</span>
                            <?php else: ?>
                                <span class="badge badge-maintenance">Unpaid</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
    </div>

    <?php if ($bills->num_rows === 0): ?>

        <div class="card">

            <div class="alert alert-error">
                No billing records found.
            </div>

        </div>

    <?php else: ?>

        <div class="card">

            <table>

                <thead>

                    <tr>

                        <th>Bill ID</th>
                        <th>Billing Period</th>
                        <th>Room</th>
                        <th>Bed</th>
                        <th>Electric</th>
                        <th>Water</th>
                        <th>Total</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($bill = $bills->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= (int) $bill["bill_id"] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $bill["billing_period"]
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $bill["room_number"]
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $bill["bed_number"]
                                ) ?>
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

                            <td>

                                <?php if (
                                    $bill["payment_status"] === "Paid"
                                ): ?>

                                    <span class="badge badge-available">
                                        Paid
                                    </span>

                                <?php elseif (
                                    $bill["payment_status"] === "Overdue"
                                ): ?>

                                    <span class="badge badge-occupied">
                                        Overdue
                                    </span>

                                <?php else: ?>

                                    <span class="badge badge-maintenance">
                                        Unpaid
                                    </span>

                                <?php endif; ?>

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