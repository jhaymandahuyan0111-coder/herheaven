<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Property Admin', 'Demo Admin');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay | Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar">
            <div class="sidebar-brand-block">
                <div class="sidebar-logo">H</div>
                <div>
                    <div class="sidebar-brand">HiveStay</div>
                    <div class="sidebar-subtitle">Admin Dashboard</div>
                </div>
            </div>

            <div class="sidebar-section-label">Administration</div>

            <nav class="sidebar-nav">
                <a class="sidebar-item active" href="#">🏠 Dashboard</a>
                <a class="sidebar-item" href="../admin/rooms.php">🚪 Room Management</a>
                <a class="sidebar-item" href="../admin/beds.php">🛏️ Bed Management</a>
                <a class="sidebar-item" href="../admin/leases.php">📋 Lease Management</a>
                <a class="sidebar-item" href="../admin/billing.php">💳 Utility Billing</a>
                <a class="sidebar-item" href="../admin/reports.php">📊 Reports</a>
            </nav>

            <div class="sidebar-user-box">
                <div class="sidebar-user-name"><?= htmlspecialchars($_SESSION['full_name'] ?? 'Demo Admin') ?></div>
                <div class="sidebar-user-role"><?= htmlspecialchars($_SESSION['role'] ?? 'Property Admin') ?></div>
                <a class="sidebar-logout" href="logout.php">⬡ Log Out</a>
            </div>
        </aside>

        <main class="dashboard-main-panel">
            <div class="page-header">
                <div>
                    <h1>Admin Dashboard</h1>
                    <p>HiveStay: Youth Co-Living and Micro-Housing</p>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="stat-icon orange">👤</div>
                        <div>
                            <div class="stat-number">128</div>
                            <div class="stat-label">Total Residents</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon amber">🛡️</div>
                        <div>
                            <div class="stat-number">12</div>
                            <div class="stat-label">Active Staff</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">🛏️</div>
                        <div>
                            <div class="stat-number">18</div>
                            <div class="stat-label">Available Beds</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon red">💳</div>
                        <div>
                            <div class="stat-number">07</div>
                            <div class="stat-label">Unpaid Bills</div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-two-col">
                    <div class="panel-box">
                        <h3>Quick Navigation</h3>
                        <div class="quick-grid">
                            <a href="../admin/rooms.php">🚪 Room Management</a>
                            <a href="../admin/beds.php">🛏️ Bed Management</a>
                            <a href="../admin/leases.php">📋 Lease Management</a>
                            <a href="../admin/billing.php">💳 Utility Billing</a>
                            <a href="../admin/reports.php">📊 Reports</a>
                        </div>
                    </div>

                    <div class="panel-box">
                        <h3>Room Occupancy</h3>
                        <div class="occupancy-row">
                            <div class="occupancy-label">Room 101</div>
                            <div class="occupancy-bar"><span style="width: 76%"></span></div>
                        </div>
                        <div class="occupancy-row">
                            <div class="occupancy-label">Room 102</div>
                            <div class="occupancy-bar"><span style="width: 50%"></span></div>
                        </div>
                        <div class="occupancy-row">
                            <div class="occupancy-label">Room 103</div>
                            <div class="occupancy-bar"><span style="width: 90%"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>


        </div>

    </div>

</body>

</html>