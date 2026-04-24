<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../config/db.php");

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!$isLoggedIn) {
        echo "<div class='alert alert-danger'>Login required</div>";
    } else {

        $title = $_POST['title'];
        $subject_id = $_POST['subject'];
        $user_id = $_SESSION['user_id'];

        $file = $_FILES['file'];

        $allowed = ['pdf','doc','docx','pdf','img','png','jpg'];
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
            die("Invalid file type");
        }

        if ($file['error'] == 0) {

            $filename = time() . "_" . basename($file['name']);
            $path = "../uploads/" . $filename;

            if (move_uploaded_file($file['tmp_name'], $path)) {

                $sql = "INSERT INTO notes (user_id, subject_id, title, file_path)
                        VALUES ($user_id, $subject_id, '$title', '$filename')";

                if ($conn->query($sql)) {
                    header("Location: notes.php");
                    exit();
                } else {
                    echo $conn->error;
                }
            }
        }
    }
}

include("../includes/header.php");
?>

<div class="row justify-content-center">
<div class="col-md-6">

<div class="card p-4 shadow-soft">
<h4 class="text-center mb-3">Upload Notes</h4>

<?php if(!$isLoggedIn): ?>
<div class="alert alert-warning text-center">
Login to upload notes
</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="title" class="form-control mb-3" placeholder="Title" required>

<select name="subject" class="form-select mb-3">
<?php
$res = $conn->query("SELECT * FROM subjects");
while($row = $res->fetch_assoc()){
    echo "<option value='{$row['id']}'>{$row['name']}</option>";
}
?>
</select>

<input type="file" name="file" class="form-control mb-3">

<button class="btn btn-primary w-100" <?= !$isLoggedIn ? 'disabled' : '' ?>>
Upload
</button>

</form>

</div>
</div>
</div>

<?php include("../includes/footer.php"); ?>