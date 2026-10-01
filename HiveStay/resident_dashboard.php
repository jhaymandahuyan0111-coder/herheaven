<?php
session_start();
require_once __DIR__ . '/mock_data.php';
ensure_mock_session('Resident', 'Demo Resident');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay | Resident Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar resident-sidebar">
            <div class="sidebar-brand-block">
                <div class="sidebar-logo">H</div>
                <div>
                    <div class="sidebar-brand">HiveStay</div>
                    <div class="sidebar-subtitle">Resident Dashboard</div>
                </div>
            </div>

            <div class="sidebar-section-label">Resident Portal</div>

            <nav class="sidebar-nav">
                <a class="sidebar-item active" href="#">🏠 My Dashboard</a>
                <a class="sidebar-item" href="book_bed.php">🛏️ Available Beds</a>
                <a class="sidebar-item" href="my_lease.php">📋 My Lease</a>
                <a class="sidebar-item" href="my_bills.php">💳 My Bills</a>
                <a class="sidebar-item" href="book_bed.php">🔔 Request Assistance</a>
            </nav>

            <div class="sidebar-user-box">
                <div class="sidebar-user-name"><?= htmlspecialchars($_SESSION['full_name'] ?? 'Demo Resident') ?></div>
                <div class="sidebar-user-role"><?= htmlspecialchars($_SESSION['role'] ?? 'Resident') ?></div>
                <a class="sidebar-logout" href="logout.php">⬡ Log Out</a>
            </div>
        </aside>

        <main class="dashboard-main-panel">
            <div class="page-header">
                <div>
                    <h1>Welcome, <?= htmlspecialchars(explode(' ', $_SESSION['full_name'] ?? 'Demo Resident')[0]) ?>! 👋</h1>
                    <p>HiveStay: Youth Co-Living and Micro-Housing</p>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="welcome-banner">
                    <div>
                        <div class="welcome-tag">Your Accommodation</div>
                        <h2>Room 102 — Bed B2</h2>
                        <p>Premium Room · ₱12,500/month</p>
                    </div>
                    <div class="welcome-meta">
                        <div class="welcome-tag small">Lease Period</div>
                        <strong>Aug 2026 → Aug 2027</strong>
                    </div>
                </div>

                <div class="stat-grid">
                    <div class="stat-card tint-gold">
                        <div class="stat-icon orange">💳</div>
                        <div>
                            <div class="stat-number">2</div>
                            <div class="stat-label">Unpaid Bills</div>
                        </div>
                    </div>
                    <div class="stat-card tint-yellow">
                        <div class="stat-icon amber">🔔</div>
                        <div>
                            <div class="stat-number">1</div>
                            <div class="stat-label">Pending Requests</div>
                        </div>
                    </div>
                    <div class="stat-card tint-blue">
                        <div class="stat-icon blue">📄</div>
                        <div>
                            <div class="stat-number">6</div>
                            <div class="stat-label">Total Bills</div>
                        </div>
                    </div>
                </div>

                <div class="panel-box">
                    <h3>Quick Actions</h3>
                    <div class="quick-grid">
                        <a href="book_bed.php">🛏️ Available Beds</a>
                        <a href="my_lease.php">📋 My Lease</a>
                        <a href="my_bills.php">💳 My Bills</a>
                        <a href="book_bed.php">🔔 Request Assistance</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
