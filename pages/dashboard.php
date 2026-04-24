<?php
session_start();
include("../config/db.php");

// 🔒 check login
if(!isset($_SESSION['user_id'])){
    die("User not logged in");
}

$user_id = $_SESSION['user_id'];

// 📊 TOTAL NOTES (by user)
$notes = $conn->query("SELECT COUNT(*) as c FROM notes WHERE user_id=$user_id")
              ->fetch_assoc()['c'];

// 📊 TOTAL DOWNLOADS
$downloads = $conn->query("SELECT SUM(downloads) as d FROM notes WHERE user_id=$user_id")
                  ->fetch_assoc()['d'];
$downloads = $downloads ? $downloads : 0;

// 📊 TOTAL SUBJECTS (global or user-based)
$subjects = $conn->query("SELECT COUNT(*) as c FROM subjects")
                 ->fetch_assoc()['c'];

include("../includes/header.php");
?>

<h4 class="mb-4 fw-bold">Dashboard</h4>

<div class="row g-4">

    <!-- NOTES -->
    <div class="col-md-4">
        <div class="card stat-card p-4 text-center">
            <i class="bi bi-file-earmark-text fs-2 text-primary"></i>
            <h3 class="mt-2"><?= $notes ?></h3>
            <p class="text-muted mb-0">Your Notes</p>
        </div>
    </div>

    <!-- DOWNLOADS -->
    <div class="col-md-4">
        <div class="card stat-card p-4 text-center">
            <i class="bi bi-download fs-2 text-success"></i>
            <h3 class="mt-2"><?= $downloads ?></h3>
            <p class="text-muted mb-0">Total Downloads</p>
        </div>
    </div>

    <!-- SUBJECTS -->
    <div class="col-md-4">
        <div class="card stat-card p-4 text-center">
            <i class="bi bi-book fs-2 text-warning"></i>
            <h3 class="mt-2"><?= $subjects ?></h3>
            <p class="text-muted mb-0">Subjects</p>
        </div>
    </div>

</div>
</div>  <!-- end of stat cards -->

<h5 class="mt-5 mb-3 fw-bold text-center text-primary">
    <i class="bi bi-clock-history"></i> Recent Notes
</h5><div class="row g-4 justify-content-center">
<?php
$res = $conn->query("SELECT * FROM notes WHERE user_id=$user_id ORDER BY id DESC LIMIT 3");

if($res && $res->num_rows > 0):
    while($row = $res->fetch_assoc()):
?>

<div class="col-md-4">
    <div class="card recent-card p-3 h-100">

        <!-- Title -->
        <h6 class="fw-semibold mb-1">
            <i class="bi bi-file-earmark-text text-primary"></i>
            <?= $row['title'] ?>
        </h6>

        <!-- Meta -->
        <p class="text-muted small mb-2">
            <i class="bi bi-download text-success"></i>
            <?= $row['downloads'] ?> downloads
        </p>

        <!-- File Type Badge -->
        <?php
        $ext = pathinfo($row['file_path'], PATHINFO_EXTENSION);
        ?>
        <span class="badge bg-light text-dark mb-2"><?= strtoupper($ext) ?></span>

        <!-- Action -->
        <a href="download.php?id=<?= $row['id'] ?>" 
           class="btn btn-outline-primary btn-sm mt-auto">
           <i class="bi bi-download"></i> Download
        </a>

    </div>
</div>

<?php
    endwhile;
else:
?>
    <div class="text-center text-muted">
        <i class="bi bi-folder-x fs-2"></i>
        <p>No notes uploaded yet</p>
    </div>
<?php endif; ?>
</div>

<?php include("../includes/footer.php"); ?>