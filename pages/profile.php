<?php
session_start();
include("../config/db.php");

// 🔒 check login
if(!isset($_SESSION['user_id'])){
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];

// ✅ user
$user = $conn->query("SELECT * FROM users WHERE id=$user_id")->fetch_assoc();

// ✅ stats
$notes = $conn->query("SELECT COUNT(*) as c FROM notes WHERE user_id=$user_id")->fetch_assoc()['c'];

$downloads = $conn->query("SELECT SUM(downloads) as d FROM notes WHERE user_id=$user_id")->fetch_assoc()['d'];
$downloads = $downloads ? $downloads : 0;

// 👉 header
include("../includes/header.php");
?>

<div class="container py-4">

    <!-- 🔥 PROFILE CARD -->
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <div class="profile-card">

                <div class="profile-header"></div>

                <div class="profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <h4 class="profile-name"><?= htmlspecialchars($user['name']) ?></h4>
                <p class="profile-sub">Student</p>

                <!-- STATS -->
                <div class="profile-stats">
                    <div>
                        <h6><?= $notes ?></h6>
                        <small>Notes</small>
                    </div>
                    <div>
                        <h6><?= $downloads ?></h6>
                        <small>Downloads</small>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- 🔥 MY NOTES -->
    <h5 class="mt-5 mb-4 fw-bold text-center">My Uploaded Notes</h5>

    <div class="row g-4 justify-content-center">

    <?php
    $res = $conn->query("SELECT * FROM notes WHERE user_id=$user_id");

    if($res && $res->num_rows > 0):
        while($row = $res->fetch_assoc()):
    ?>

    <div class="col-md-6 col-lg-4">
        <div class="card note-card p-3 h-100 text-center">

            <h6 class="fw-semibold"><?= htmlspecialchars($row['title']) ?></h6>

            <small class="text-muted mb-2">
                <i class="bi bi-download"></i>
                <?= $row['downloads'] ?> downloads
            </small>

            <div class="d-flex justify-content-center gap-2 mt-2">

                <!-- DOWNLOAD -->
                <a href="download.php?id=<?= $row['id'] ?>" 
                   class="btn btn-primary btn-sm">
                   <i class="bi bi-download"></i>
                </a>

                <!-- EDIT -->
                <a href="edit_note.php?id=<?= $row['id'] ?>" 
                   class="btn btn-warning btn-sm">
                   <i class="bi bi-pencil"></i>
                </a>

                <!-- DELETE -->
                <a href="delete_note.php?id=<?= $row['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this note?')">
                   <i class="bi bi-trash"></i>
                </a>

            </div>

        </div>
    </div>

    <?php endwhile; else: ?>

        <div class="text-center text-muted">
            <i class="bi bi-folder-x fs-2"></i>
            <p>No notes uploaded yet</p>
        </div>

    <?php endif; ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>