
<?php

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

require_once __DIR__ . '/../config/database.php';

try {

    // Retrieve all uploaded photographs.
    $query = "
        SELECT
            photo_id,
            stored_filename,
            uploaded_at
        FROM photos
        ORDER BY photo_id ASC
    ";

    $stmt = $pdo->query($query);

    $records = $stmt->fetchAll();

    $photos = [];

    // Build public image URLs.
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
        'message' => 'Unable to retrieve slideshow photos.'
    ]);
}
