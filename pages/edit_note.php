<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    die("Unauthorized");
}

$user_id = $_SESSION['user_id'];
$id = (int)$_GET['id'];

// ✅ FETCH NOTE
$res = $conn->query("SELECT * FROM notes WHERE id=$id AND user_id=$user_id");

if(!$res || $res->num_rows == 0){
    die("Access denied");
}

$note = $res->fetch_assoc();

include("../includes/header.php");
?>

<h4 class="mb-4">Edit Note</h4>

<form method="POST" enctype="multipart/form-data">

    <!-- TITLE -->
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control"
               value="<?= htmlspecialchars($note['title']) ?>" required>
    </div>

    <!-- FILE (OPTIONAL UPDATE) -->
    <div class="mb-3">
        <label class="form-label">Replace File (optional)</label>
        <input type="file" name="file" class="form-control">
    </div>

    <button class="btn btn-primary">Update Note</button>

</form>

<?php
// 🔥 UPDATE LOGIC
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $title = $conn->real_escape_string($_POST['title']);

    // FILE UPLOAD
    if(!empty($_FILES['file']['name'])){

        $newFile = time() . "_" . $_FILES['file']['name'];
        $target = "../uploads/" . $newFile;

        // 🔥 DELETE OLD FILE
        $oldFile = "../uploads/" . $note['file_path'];
        if(file_exists($oldFile)){
            unlink($oldFile);
        }

        // MOVE NEW FILE
        move_uploaded_file($_FILES['file']['tmp_name'], $target);

        // UPDATE WITH FILE
        $conn->query("UPDATE notes SET title='$title', file_path='$newFile' WHERE id=$id");

    } else {
        // UPDATE ONLY TITLE
        $conn->query("UPDATE notes SET title='$title' WHERE id=$id");
    }

    echo "<script>
        alert('Note updated successfully');
        window.location='profile.php';
    </script>";
}

include("../includes/footer.php");
?>