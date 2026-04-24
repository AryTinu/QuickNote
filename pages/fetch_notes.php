<?php
include("../config/db.php");

$search  = $_GET['search']  ?? '';
$subject = $_GET['subject'] ?? '';
$sort    = $_GET['sort']    ?? 'latest';

// ✅ QUERY
$sql = "SELECT notes.*, subjects.name AS subject 
        FROM notes 
        JOIN subjects ON notes.subject_id = subjects.id
        WHERE 1";

if(!empty($search)){
    $sql .= " AND notes.title LIKE '%$search%'";
}

if(!empty($subject)){
    $sql .= " AND subjects.id = $subject";
}

if($sort == 'downloads'){
    $sql .= " ORDER BY notes.downloads DESC";
} else {
    $sql .= " ORDER BY notes.id DESC";
}

$res = $conn->query($sql);

// ✅ LOOP STARTS HERE
if($res && $res->num_rows > 0):
    while($row = $res->fetch_assoc()):
?>

<div class="col-md-4">
    <div class="card p-3 h-100 note-card">

        <h6>
            <?= $row['title'] ?>
        </h6>

        <p class="text-muted">
            <?= $row['subject'] ?>
        </p>

        <p>
            <?= $row['downloads'] ?> downloads
        </p>

        <div class="d-flex gap-2 mt-auto">

            <a href="download.php?id=<?= $row['id'] ?>"
               class="btn btn-primary btn-sm w-100">
               Download
            </a>

            <button class="btn btn-outline-secondary btn-sm w-100"
    data-bs-toggle="modal"
    data-bs-target="#previewModal"
    onclick="previewFile(
        '<?= htmlspecialchars($row['file_path'], ENT_QUOTES) ?>',
        '<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>',
        <?= (int)$row['downloads'] ?>
    )">
    Preview
</button>

        </div>

    </div>
</div>

<?php
    endwhile;
else:
?>

<div class="text-center text-muted">
    <p>No notes found</p>
</div>

<?php endif; ?>