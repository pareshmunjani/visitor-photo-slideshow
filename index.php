
<?php
// Visitor Photo Slideshow - Visitor Upload Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visitor Photo Slideshow</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <main class="page-container">

        <section class="upload-card">

            <div class="header">
                <div class="header-icon">📸</div>

                <h1>Visitor Photo Slideshow</h1>

                <p>
                    Welcome! Share your favourite moments with us.
                    Your photos may appear on our shared display.
                </p>
            </div>

            <form action="upload.php" method="POST"
                  enctype="multipart/form-data">

                <!-- Visitor Name -->
                <div class="form-group">

                    <label for="name">Your Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your full name"
                        maxlength="100"
                        required
                    >

                </div>

                <!-- Visitor Email -->
                <div class="form-group">

                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email address"
                        maxlength="254"
                        required
                    >

                    <small>
                        Your email helps us recognize you when you visit again.
                        It will never be displayed publicly.
                    </small>

                </div>

                <!-- Photo Upload -->
                <div class="form-group">

                    <label for="photos">Choose Your Photos</label>

                    <div class="upload-area">

                        <input
                            type="file"
                            id="photos"
                            name="photos[]"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                            required
                        >

                        <p>Select up to 5 photos</p>

                        <small>
                            JPG, JPEG, PNG or WebP · Maximum 5 MB per photo
                        </small>

                    </div>

                    <div id="photo-preview" class="photo-preview"></div>

                    <p id="photo-error" class="error-message"></p>

                </div>

                <!-- Consent -->
                <div class="consent-group">

                    <input
                        type="checkbox"
                        id="consent"
                        name="consent"
                        value="1"
                        required
                    >

                    <label for="consent">
                        I confirm that I have permission to upload and
                        publicly display these photos. I understand that
                        they will be stored and shown on a shared display
                        until removed by the administrator.
                    </label>

                </div>

                <!-- Submit -->
                <button type="submit" id="submit-button">
                    Submit Photos
                </button>

            </form>

            <footer>
                <p>Thank you for sharing your memories ❤️</p>
            </footer>

        </section>

    </main>

    <script src="assets/js/upload.js"></script>

</body>
</html>
