
<?php

session_start();

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

// Check whether a visitor has an active upload session.
if (
    !isset($_SESSION['visitor_id']) ||
    (int) $_SESSION['visitor_id'] <= 0
) {
    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Please upload your photos first.'
    ]);

    exit;
}

$visitorId = (int) $_SESSION['visitor_id'];

require_once __DIR__ . '/../config/database.php';

try {

    // Retrieve ONLY the current visitor's photographs.
    $query = "
        SELECT
            photo_id,
            stored_filename,
            uploaded_at
        FROM photos
        WHERE visitor_id = :visitor_id
        ORDER BY photo_id ASC
    ";

    $stmt = $pdo->prepare($query);

    $stmt->execute([
        ':visitor_id' => $visitorId
    ]);

    $records = $stmt->fetchAll();

    $photos = [];

    // Build image URLs.
    $basePath = rtrim(
        dirname(dirname($_SERVER['SCRIPT_NAME'])),
        '/'
    );

    foreach ($records as $record) {

        $filename = basename($record['stored_filename']);

        $photos[] = [
            'id' => (int) $record['photo_id'],
            'image_url' => $basePath . '/uploads/' .
                rawurlencode($filename)
        ];
    }

    echo json_encode([
        'success' => true,
        'photos' => $photos
    ]);

} catch (Throwable $e) {

    error_log('Slideshow retrieval failed: ' . $e->getMessage());

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Unable to retrieve your slideshow photos.'
    ]);
}
