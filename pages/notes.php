<?php
session_start();
include("../config/db.php");
include("../includes/header.php");

// 📚 FETCH SUBJECTS ONLY (no main query here)
$subjects = $conn->query("SELECT * FROM subjects");
?>

<h4 class="mb-3 fw-bold">Browse Notes</h4>

<!-- 🔥 FILTER BAR -->
<form class="row g-3 mb-4" onsubmit="return false;">

    <!-- SEARCH -->
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Search notes...">
    </div>

    <!-- SUBJECT FILTER -->
    <div class="col-md-3">
        <select name="subject" class="form-select">
            <option value="">All Subjects</option>
            <?php while($s = $subjects->fetch_assoc()): ?>
                <option value="<?= $s['id'] ?>">
                    <?= $s['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- SORT -->
    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="latest">Latest</option>
            <option value="downloads">Most Downloaded</option>
        </select>
    </div>

</form>

<!-- 🔥 NOTES GRID (DYNAMIC) -->
<div id="notesContainer" class="row g-4 text-center">
    <p class="text-muted">Loading notes...</p>
</div>
<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="previewTitle">Preview</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <p class="text-muted" id="previewInfo"></p>

        <iframe id="previewFrame"
                width="100%"
                height="450px"
                style="border-radius:10px;">
        </iframe>

      </div>

    </div>
  </div>
</div>
<!-- 🔥 LIVE SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    function fetchNotes() {
        const search  = document.querySelector("input[name='search']")?.value || '';
        const subject = document.querySelector("select[name='subject']")?.value || '';
        const sort    = document.querySelector("select[name='sort']")?.value || '';

        document.getElementById("notesContainer").innerHTML =
            "<p class='text-muted text-center'>Loading...</p>";

        fetch(`fetch_notes.php?search=${encodeURIComponent(search)}&subject=${subject}&sort=${sort}`)
            .then(res => res.text())
            .then(data => {
                document.getElementById("notesContainer").innerHTML = data;
            });
    }

    // 🔥 EVENTS
    document.querySelector("input[name='search']")?.addEventListener("keyup", fetchNotes);
    document.querySelector("select[name='subject']")?.addEventListener("change", fetchNotes);
    document.querySelector("select[name='sort']")?.addEventListener("change", fetchNotes);

    fetchNotes();
});

// 🔥 IMPORTANT: GLOBAL FUNCTION (OUTSIDE DOMContentLoaded)
function previewFile(filename) {
    window.open("/QuickNote/uploads/" + filename, "_blank");
}
</script>

<?php include("../includes/footer.php"); ?>