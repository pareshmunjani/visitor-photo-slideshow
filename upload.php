
<?php

session_start();

// Send the visitor back with a message.
function redirectWithMessage(string $message, string $type = 'error'): void{
    $_SESSION['flash'] = [
        'message' => $message,
        'type' => $type
    ];

    header('Location: index.php');
    exit;
}

// Only accept POST requests.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectWithMessage('Invalid request method.');
}

// Collect visitor information.
$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$consent = $_POST['consent'] ?? '';

// Validate name.
if (
    $name === '' ||
    strlen($name) > 400 ||
    preg_match('/[\p{C}]/u', $name)
) {
    redirectWithMessage('Please enter a valid name (maximum 100 characters).');
}

if (function_exists('mb_strlen')) {
    if (mb_strlen($name, 'UTF-8') > 100) {
        redirectWithMessage('Your name cannot exceed 100 characters.');
    }
}

// Validate email.
if (
    strlen($email) > 254 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    redirectWithMessage('Please enter a valid email address.');
}

// Validate consent.
if ($consent !== '1') {
    redirectWithMessage('Please provide photo display consent.');
}

// Check uploaded files.
if (
    !isset($_FILES['photos']) ||
    !isset($_FILES['photos']['name']) ||
    !is_array($_FILES['photos']['name'])
) {
    redirectWithMessage('Please select your photos.');
}

$files = $_FILES['photos'];

$fileCount = count($files['name']);

if ($fileCount < 1 || $fileCount > 5) {
    redirectWithMessage('Please select between 1 and 5 photos.');
}

// Allowed image MIME types and their extensions.
$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp'
];

$maxFileSize = 5 * 1024 * 1024;

// Validate the complete batch before moving any file.
$validatedFiles = [];

$finfo = finfo_open(FILEINFO_MIME_TYPE);

if ($finfo === false) {
    redirectWithMessage('Server image validation is unavailable.');
}

try {

    for ($i = 0; $i < $fileCount; $i++) {

        $error = $files['error'][$i] ?? UPLOAD_ERR_NO_FILE;
        $tmpName = $files['tmp_name'][$i] ?? '';
        $size = $files['size'][$i] ?? 0;

        // Handle PHP upload errors.
        if ($error !== UPLOAD_ERR_OK) {

            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'A photo exceeds the server upload limit.',
                UPLOAD_ERR_FORM_SIZE => 'A photo exceeds the form upload limit.',
                UPLOAD_ERR_PARTIAL => 'A photo was only partially uploaded.',
                UPLOAD_ERR_NO_FILE => 'Please select all required photos.',
                UPLOAD_ERR_NO_TMP_DIR => 'Server temporary folder is missing.',
                UPLOAD_ERR_CANT_WRITE => 'Server could not write an uploaded photo.',
                UPLOAD_ERR_EXTENSION => 'A server extension stopped the upload.'
            ];

            $message = $errorMessages[$error]
                ?? 'An unknown photo upload error occurred.';

            throw new RuntimeException($message);
        }

        // Check file size.
        if ($size <= 0 || $size > $maxFileSize) {
            throw new RuntimeException(
                'Each photo must be greater than 0 bytes and no larger than 5 MB.'
            );
        }

        if (!is_uploaded_file($tmpName)) {
            throw new RuntimeException('Invalid uploaded file.');
        }

        // Check actual MIME type.
        $mimeType = finfo_file($finfo, $tmpName);

        if (!isset($allowedTypes[$mimeType])) {
            throw new RuntimeException(
                'Only JPG, JPEG, PNG and WebP images are allowed.'
            );
        }

        // Check actual image content.
        $imageInfo = getimagesize($tmpName);

        if (
            $imageInfo === false ||
            ($imageInfo['mime'] ?? '') !== $mimeType
        ) {
            throw new RuntimeException(
                'One of the selected files is not a valid image.'
            );
        }

        // Generate a unique filename.
        $filename = bin2hex(random_bytes(16))
            . '.'
            . $allowedTypes[$mimeType];

        $validatedFiles[] = [
            'tmp_name' => $tmpName,
            'filename' => $filename,
            'mime_type' => $mimeType,
            'size' => $size
        ];
    }

} catch (Throwable $e) {

    redirectWithMessage($e->getMessage());

} finally {

    finfo_close($finfo);

}

// Check uploads directory.
$uploadDirectory = __DIR__ . '/uploads';

if (!is_dir($uploadDirectory) || !is_writable($uploadDirectory)) {
    redirectWithMessage('Photo storage directory is unavailable.');
}

// Move validated files into uploads directory.
$movedFiles = [];

try {

    foreach ($validatedFiles as $file) {

        $destination = $uploadDirectory . '/'
            . $file['filename'];

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new RuntimeException(
                'Unable to save one of the selected photos.'
            );
        }

        $movedFiles[] = $destination;
    }

    // Connect to the database.
    require_once __DIR__ . '/config/database.php';

    // Begin database transaction.
    $pdo->beginTransaction();

    /*
     * Create a new visitor or reuse an existing visitor.
     *
     * LAST_INSERT_ID(visitor_id) returns the existing ID
     * when the email already exists.
     */
    $visitorQuery = "
        INSERT INTO visitors (name, email)
        VALUES (:name, :email)

        ON DUPLICATE KEY UPDATE
            visitor_id = LAST_INSERT_ID(visitor_id),
            name = :updated_name
    ";

    $visitorStmt = $pdo->prepare($visitorQuery);

    $visitorStmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':updated_name' => $name
    ]);

    $visitorId = (int) $pdo->lastInsertId();

    if ($visitorId <= 0) {
        throw new RuntimeException('Unable to identify visitor.');
    }

    // Prepare photo insertion.
    $photoQuery = "
        INSERT INTO photos (
            visitor_id,
            stored_filename,
            mime_type,
            file_size_bytes,
            consent_given,
            consent_at
        )
        VALUES (
            :visitor_id,
            :filename,
            :mime_type,
            :file_size,
            1,
            NOW()
        )
    ";

    $photoStmt = $pdo->prepare($photoQuery);

    // Insert every uploaded photo.
    foreach ($validatedFiles as $file) {

        $photoStmt->execute([
            ':visitor_id' => $visitorId,
            ':filename' => $file['filename'],
            ':mime_type' => $file['mime_type'],
            ':file_size' => $file['size']
        ]);
    }

    // Save all database changes.
    $pdo->commit();

    redirectWithMessage(
        'Your photos have been uploaded successfully. Thank you for sharing your memories!',
        'success'
    );

} catch (Throwable $e) {

    // Roll back database changes.
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }

    // Remove files already moved to the uploads directory.
    foreach ($movedFiles as $filePath) {

        if (is_file($filePath)) {
            unlink($filePath);
        }
    }

    // Keep technical errors in the server log.
    error_log('Photo upload processing failed: ' . $e->getMessage());

    redirectWithMessage(
        'We could not save your photos. Please try again.'
    );
}
