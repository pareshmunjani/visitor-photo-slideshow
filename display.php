
<?php
session_start();

$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visitor Memories | Slideshow</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="slideshow-page">

    <main class="slideshow-container">

        <header class="slideshow-heading">
            <span class="slideshow-label">SHARED MEMORIES</span>

            <h1>Moments Worth Remembering</h1>

            <p>Celebrating the memories shared by our visitors.</p>

            <?php if ($successMessage !== ''): ?>
                <p class="success-message">
                    <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>
        </header>

        <section id="waiting-message" class="waiting-message">
            <div class="waiting-icon">📸</div>
            <h2>Waiting for Memories</h2>
            <p>New photographs will appear here automatically.</p>
        </section>

        <section id="photo-stage" class="photo-stage hidden">
            <img
                id="slideshow-image"
                src=""
                alt="Visitor shared photograph"
            >
        </section>

        <div class="slideshow-controls">
            <button type="button" id="pause-play-button" disabled>
                Pause
            </button>

            <span id="playback-status">Loading photos...</span>
        </div>

        <footer class="slideshow-footer">
            <span>EVERY PICTURE HAS A STORY</span>
            <span id="photo-counter">0 PHOTOS</span>
        </footer>

    </main>

    <script src="assets/js/slideshow.js"></script>

</body>
</html>
