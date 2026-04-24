    </div> <!-- container -->
</main> <!-- IMPORTANT: close main, not main-content -->

<footer class="footer py-4 mt-auto">
    <div class="container">

        <div class="row align-items-center text-center text-md-start">

            <!-- Brand -->
            <div class="col-md-4 mb-2">
                <h6 class="fw-bold text-primary mb-0">
                    <i class="bi bi-journal-bookmark-fill"></i> QuickNote
                </h6>
                <small class="text-muted">Smart Notes Sharing Platform</small>
            </div>

            <!-- Links -->
            <div class="col-md-4 mb-2">
                <div class="d-flex justify-content-center gap-3">
                    <a href="dashboard.php" class="footer-link">Dashboard</a>
                    <a href="notes.php" class="footer-link">Notes</a>
                    <a href="upload.php" class="footer-link">Upload</a>
                </div>
            </div>

            <!-- Social -->
            <div class="col-md-4 mb-2">
                <div class="d-flex justify-content-center justify-content-md-end gap-3">
                    <i class="bi bi-github footer-icon"></i>
                    <i class="bi bi-linkedin footer-icon"></i>
                    <i class="bi bi-envelope footer-icon"></i>
                </div>
            </div>

        </div>

        <hr class="my-2">

        <div class="text-center small text-muted">
            © <?= date("Y") ?> QuickNote • Built with PHP & MySQL
        </div>

    </div>
</footer>

</body>
</html>