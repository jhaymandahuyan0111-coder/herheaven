<?php
session_start();
require_once __DIR__ . '/mock_data.php';

$currentRole = $_GET['role'] ?? 'admin';
if (!in_array($currentRole, ['admin', 'resident'], true)) {
    $currentRole = 'admin';
}

$isResidentPortal = $currentRole === 'resident';

if (!isset($_SESSION['user_id'])) {
    ensure_mock_session($isResidentPortal ? 'Resident' : 'Property Admin', $isResidentPortal ? 'Demo Resident' : 'Demo Admin');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay | <?= $isResidentPortal ? 'Resident Login' : 'Admin Login' ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">
    <div class="auth-shell">
        <aside class="auth-panel" style="background: <?= $isResidentPortal ? 'linear-gradient(160deg, #3D1400 0%, #892E00 100%)' : 'linear-gradient(160deg, #892E00 0%, #E17D12 100%)' ?>;">
            <div class="auth-brand-row">
                <div class="auth-brand-mark">H</div>
                <span class="auth-brand-name">HiveStay</span>
            </div>

            <h1><?= $isResidentPortal ? 'Resident<br>Portal' : 'Admin &amp;<br>Staff Portal' ?></h1>
            <p class="auth-panel-copy"><?= $isResidentPortal ? 'Access your dashboard to manage your bed booking, lease, bills, and assistance requests.' : 'Manage residents, rooms, leases, billing, and operations from the HiveStay administration dashboard.' ?></p>

            <div class="auth-demo-box">
                <p class="auth-demo-label">Demo Credentials</p>
                <p><?= $isResidentPortal ? 'maria_s / res123' : 'admin / admin123' ?></p>
                <p><?= $isResidentPortal ? 'juan_d / res456' : 'staff1 / staff123' ?></p>
            </div>
        </aside>

        <main class="auth-form-area" style="background: #FFFDF0;">
            <div class="auth-form-wrap">
                <a href="select_role.php" class="auth-back-link">Back to Role Selection</a>

                <h2><?= $isResidentPortal ? 'Welcome back' : 'Sign in' ?></h2>
                <p class="auth-subtitle"><?= $isResidentPortal ? 'Sign in to your resident account' : 'Enter your admin or staff credentials' ?></p>

                <form method="GET" class="auth-form" action="<?= $isResidentPortal ? 'resident_dashboard.php' : 'dashboard.php' ?>">
                    <div class="auth-field">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="hs-input" placeholder="Enter username" value="demo" required>
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="hs-input" placeholder="Enter password" value="demo" required>
                    </div>

                    <button type="submit" class="hs-btn-primary auth-submit">Continue</button>
                </form>

                <?php if ($isResidentPortal): ?>
                    <div class="auth-signup-row">
                        <span>Don't have an account?</span>
                        <a href="resident_signup.php">Sign Up</a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>