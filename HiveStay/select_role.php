<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay | Select Your Role</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="role-select-body">
    <div class="role-select-shell">
        <a class="role-back-link" href="index.php">Back to Home</a>

        <div class="role-brand" aria-label="HiveStay brand">
            <div class="role-brand-mark">H</div>
            <div class="role-brand-name">HiveStay</div>
        </div>

        <header class="role-select-head">
            <h1>Select Your Role</h1>
            <p>Choose how you'd like to access the HiveStay portal</p>
        </header>

        <main class="role-cards">
            <section class="role-card" aria-labelledby="admin-role-title">
                <div class="role-icon-wrap" aria-hidden="true">🛡️</div>
                <h2 class="role-title" id="admin-role-title">Admin / Staff</h2>
                <p class="role-copy">
                    Access the management portal for administrators and staff members.
                    Manage residents, rooms, leases, billing and more.
                </p>
                <div class="role-actions">
                    <a class="role-button" href="login.php?role=admin">Admin / Staff Login</a>
                </div>
            </section>

            <section class="role-card" aria-labelledby="resident-role-title">
                <div class="role-icon-wrap" aria-hidden="true">🏡</div>
                <h2 class="role-title" id="resident-role-title">Resident</h2>
                <p class="role-copy">
                    Already a HiveStay resident? Log in to manage your bed, view your lease,
                    pay bills, and request assistance.
                </p>
                <div class="role-actions">
                    <a class="role-button" href="login.php?role=resident">Resident Login</a>
                    <a class="role-button-secondary" href="#">Sign Up as Resident</a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
