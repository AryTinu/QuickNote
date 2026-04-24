<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QuickNote</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            font-family: 'Segoe UI', sans-serif;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            padding: 12px 0;
            background: rgba(255,255,255,0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e5e7eb;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: #4f46e5 !important;
        }

        .nav-link {
            font-weight: 500;
            color: #374151 !important;
        }

        .nav-link:hover {
            color: #4f46e5 !important;
        }

        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 16px;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            animation: fadeIn 0.4s ease-in;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }

        /* ===== BUTTONS ===== */
        .btn {
            border-radius: 10px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4f46e5, #6366f1);
            border: none;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        /* ===== INPUTS ===== */
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #e5e7eb;
        }

        /* ===== FOOTER ===== */
        .footer {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            border-top: 1px solid #e5e7eb;
        }

        .footer-link {
            text-decoration: none;
            color: #6b7280;
            font-size: 14px;
            transition: 0.2s;
        }

        .footer-link:hover {
            color: #4f46e5;
            transform: translateY(-2px);
        }

        .footer-icon {
            font-size: 18px;
            color: #6b7280;
            cursor: pointer;
            transition: 0.2s;
        }

        .footer-icon:hover {
            color: #4f46e5;
            transform: scale(1.2);
        }
        <style>
.profile-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.profile-card {
    width: 320px;
    background: white;
    border-radius: 20px;
    text-align: center;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.profile-top {
    height: 90px;
    background: linear-gradient(45deg, #4f46e5, #6366f1);
    border-radius: 20px 20px 0 0;
    margin: -20px -20px 0 -20px;
}

.profile-img {
    width: 90px;
    height: 90px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin: -45px auto 10px;
    border: 4px solid white;
    color: #4f46e5;
}
.profile-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 70vh;
}

/* CARD */
.profile-card {
    width: 320px;
    background: #fff;
    border-radius: 20px;
    text-align: center;
    position: relative;
    padding-bottom: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    overflow: hidden;
}

/* TOP BLUE SECTION */
.profile-header {
    height: 110px;
    background: linear-gradient(135deg, #4f46e5, #5b6cf0);
}

/* AVATAR */
.profile-avatar {
    width: 95px;
    height: 95px;
    border-radius: 50%;
    background: #fff;
    position: absolute;
    top: 60px;
    left: 50%;
    transform: translateX(-50%);
    border: 4px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 42px;
    color: #4f46e5;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* NAME */
.profile-name {
    margin-top: 60px;
    font-weight: 600;
}

/* SUBTEXT */
.profile-sub {
    color: #777;
    font-size: 14px;
    margin-bottom: 10px;
}

/* SOCIAL ICONS */
.profile-social {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 10px 0;
}

.profile-social i {
    font-size: 20px;
    color: #555;
    cursor: pointer;
    transition: 0.2s;
}

.profile-social i:hover {
    color: #4f46e5;
    transform: scale(1.2);
}

/* BUTTON */
.profile-btn {
    border-radius: 25px;
    padding: 6px 25px;
    margin-top: 10px;
}
.profile-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 10px 0;
}

.profile-stats h6 {
    font-weight: 600;
    margin: 0;
    color: #4f46e5;
}

.profile-stats small {
    color: #777;
}
.stat-card {
    border-radius: 16px;
    background: rgba(255,255,255,0.9);
    transition: 0.3s;
    backdrop-filter: blur(10px);
}

.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}
.recent-card {
    border-radius: 14px;
    transition: 0.3s;
    background: rgba(255,255,255,0.9);
}

.recent-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.note-card {
    border-radius: 14px;
    transition: 0.3s;
}

.note-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
/* ===== PROFILE CARD ===== */
.profile-card {
    border-radius: 20px;
    background: white;
    padding: 25px;
    text-align: center;
    position: relative;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    overflow: hidden;
}

.profile-header {
    height: 100px;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    margin: -25px -25px 0 -25px;
    border-radius: 20px 20px 0 0;
}

.profile-avatar {
    width: 90px;
    height: 90px;
    background: white;
    border-radius: 50%;
    margin: -45px auto 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: #4f46e5;
    border: 4px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

.profile-name {
    margin-top: 10px;
    font-weight: 600;
}

.profile-sub {
    color: #777;
    font-size: 14px;
}

.profile-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 15px;
}

.profile-stats h6 {
    margin: 0;
    font-weight: 600;
    color: #4f46e5;
}

/* ===== NOTES ===== */
.note-card {
    border-radius: 14px;
    transition: 0.3s;
}

.note-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

</style>
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand" href="#">
            <i class="bi bi-journal-bookmark-fill"></i> QuickNote
        </a>

        <!-- NAVBAR BUTTONS -->
        <div class="collapse navbar-collapse">

            <div class="navbar-nav ms-auto d-flex align-items-center gap-3">

                <a href="dashboard.php" class="nav-link">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="notes.php" class="nav-link">
                    <i class="bi bi-file-earmark-text"></i> Notes
                </a>

                <a href="upload.php" class="nav-link">
                    <i class="bi bi-upload"></i> Upload
                </a>

                <a href="profile.php" class="nav-link">
                    <i class="bi bi-person"></i> Profile
                </a>

                <a href="../auth/logout.php" class="btn btn-danger btn-sm ms-2">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>

            </div>

        </div>

    </div>
</nav>

<!-- MAIN CONTENT -->
<main class="flex-grow-1">
    <div class="container mt-4">