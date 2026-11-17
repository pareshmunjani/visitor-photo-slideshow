
<?php
session_start();

// Only visitors who have successfully uploaded photos can view this slideshow.
if (
    !isset($_SESSION['visitor_id']) ||
    (int) $_SESSION['visitor_id'] <= 0
) {
    header('Location: index.php');
    exit;
}

$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Memories | Slideshow</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="slideshow-page">

    <main class="slideshow-container">

        <header class="slideshow-heading">

            <span class="slideshow-label">YOUR MEMORIES</span>

            <h1>Moments Worth Remembering</h1>

            <p>Your photographs, your memories.</p>

            <?php if ($successMessage !== ''): ?>
                <p class="success-message">
                    <?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <a href="index.php" class="back-home-link">
                &larr; Back to Home
            </a>

        </header>

        <section id="waiting-message" class="waiting-message">
            <div class="waiting-icon">📸</div>
            <h2>Waiting for Memories</h2>
            <p>Your uploaded photographs will appear here automatically.</p>
        </section>

        <section id="photo-stage" class="photo-stage hidden">
            <img
                id="slideshow-image"
                src=""
                alt="Your uploaded photograph"
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
