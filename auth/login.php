<?php
session_start();
include("../config/db.php");

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    // ✅ GET INPUT
    $email = $_POST['email'];
    $password = $_POST['password'];

    // ✅ FETCH USER
    $res = $conn->query("SELECT * FROM users WHERE email='$email'");

    if($res && $res->num_rows > 0){
    //push code
        $user = $res->fetch_assoc();

        // ✅ COMPARE PASSWORD (PLAIN TEXT)
        if($password == $user['password']){
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../pages/dashboard.php");
            exit;
        } else {
            $error = "Invalid password";
        }

    } else {
        $error = "User not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - QuickNote</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

/* ===== ANIMATED GRADIENT ===== */
body {
    margin: 0;
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;

    background: linear-gradient(-45deg, #5eb2fc, #5e94cb, #9575f6, #aa6dff);
    background-size: 400% 400%;
    animation: gradientFlow 12s ease infinite;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ===== PARTICLES ===== */
#particles {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 0;
    top: 0;
    left: 0;
}

/* ===== WRAPPER ===== */
.login-wrapper {
    position: relative;
    z-index: 2;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* ===== GLASS CARD ===== */
.login-card {
    display: flex;
    border-radius: 20px;
    overflow: hidden;

    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);

    border: 1px solid rgba(255,255,255,0.2);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

/* LEFT */
.login-left {
    background: linear-gradient(160deg, #6d63d7c0, #6365f1b8, #8a5cf6a2);
    color: white;
    padding: 40px;
    width: 350px;
}

/* RIGHT */
.login-right {
    padding: 40px;
    width: 350px;
}

/* INPUTS */
.form-control {
    border-radius: 10px;
    padding: 10px;
}

.form-control:focus {
    box-shadow: 0 0 0 2px rgba(99,102,241,0.3);
    border-color: #6366f1;
}

/* BUTTON */
.btn-primary {
    border-radius: 10px;
    background: linear-gradient(45deg, #4f46e5, #6366f1);
    border: none;
}

</style>
</head>

<body>

<!-- PARTICLES -->
<canvas id="particles"></canvas>

<div class="login-wrapper">

    <div class="login-card">

        <!-- LEFT -->
        <div class="login-left">
            <h2>Welcome to QuickNote 📒</h2>
            <p class="mt-3">
                Store, share, and access your notes anytime.
            </p>

            <ul class="mt-4">
                <li>📄 Upload Notes</li>
                <li>🔍 Search Easily</li>
                <li>⬇️ Download Anytime</li>
            </ul>
        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <h4 class="mb-3">Login</h4>

            <?php if($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" autocomplete="off">

                <!-- fake fields (prevent autofill) -->
                <input type="text" name="fakeuser" style="display:none">
                <input type="password" name="fakepass" style="display:none">

                <!-- EMAIL -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           autocomplete="off" required>
                </div>

                <!-- PASSWORD -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control"
                           autocomplete="new-password" required>
                </div>

                <button class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>

            </form>

            <p class="mt-3 text-center">
                Don't have an account? <a href="register.php">Register</a>
            </p>

        </div>

    </div>

</div>

<!-- PARTICLES SCRIPT -->
<script>
const canvas = document.getElementById("particles");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let particles = [];

for (let i = 0; i < 60; i++) {
    particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 2 + 1,
        dx: (Math.random() - 0.5) * 0.5,
        dy: (Math.random() - 0.5) * 0.5
    });
}

function drawParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "rgba(255,255,255,0.6)";

    particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fill();

        p.x += p.dx;
        p.y += p.dy;

        if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
    });

    requestAnimationFrame(drawParticles);
}

drawParticles();
</script>

</body>
</html>