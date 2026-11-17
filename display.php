
<?php
// Full-screen visitor photo slideshow.
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Visitor Memories | Slideshow</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body class="slideshow-body">

    <main class="slideshow-container">

        <div class="slideshow-heading">
            <span class="slideshow-label">
                SHARED MEMORIES
            </span>

            <h1>Moments Worth Remembering</h1>

            <p>
                Celebrating the memories shared by our visitors.
            </p>
        </div>

        <!-- Waiting message -->
        <div id="waiting-message" class="waiting-message">

            <div class="waiting-icon">📸</div>

            <h2>Waiting for Memories</h2>

            <p>
                New photographs will appear here automatically.
            </p>

        </div>

        <!-- Photo display -->
        <div id="photo-stage" class="photo-stage hidden">

            <img
                id="slideshow-image"
                src=""
                alt="Visitor shared photograph"
            >

        </div>

        <div class="slideshow-footer">
            <span>EVERY PICTURE HAS A STORY</span>
            <span id="photo-counter">0 PHOTOS</span>
        </div>

    </main>

    <script src="assets/js/slideshow.js"></script>

</body>

</html>
