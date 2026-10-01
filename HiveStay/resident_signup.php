<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveStay | Resident Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="auth-body">
    <div class="auth-shell">
        <aside class="auth-panel" style="background: linear-gradient(160deg, #3D1400 0%, #892E00 100%);">
            <div class="auth-brand-row">
                <div class="auth-brand-mark">H</div>
                <span class="auth-brand-name">HiveStay</span>
            </div>

            <h1>Resident<br>Sign Up</h1>
            <p class="auth-panel-copy">Create your resident account, verify your email, and take the next step toward your new home.</p>

            <div class="auth-demo-box">
                <p class="auth-demo-label">Application Steps</p>
                <p>1. Enter personal details</p>
                <p>2. Verify email OTP</p>
                <p>3. Confirm booking</p>
            </div>
        </aside>

        <main class="auth-form-area" style="background: #FFFDF0;">
            <div class="auth-form-wrap">
                <a href="select_role.php" class="auth-back-link">Back to Role Selection</a>
                <h2>Create Account</h2>
                <p class="auth-subtitle">Start your resident application with HiveStay.</p>

                <form method="POST" class="auth-form">
                    <div class="auth-field">
                        <label for="full_name">Full name</label>
                        <input type="text" id="full_name" name="full_name" class="hs-input" placeholder="Enter full name" required>
                    </div>

                    <div class="auth-field">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" class="hs-input" placeholder="Enter email address" required>
                    </div>

                    <div class="auth-field">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" name="phone" class="hs-input" placeholder="Enter phone number" required>
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="hs-input" placeholder="Create password" required>
                    </div>

                    <button type="submit" class="hs-btn-primary auth-submit">Create Account</button>
                </form>

                <div class="auth-signup-row">
                    <span>Already registered?</span>
                    <a href="login.php?role=resident">Sign In</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
