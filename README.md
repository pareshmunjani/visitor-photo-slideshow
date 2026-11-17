
## Photo Upload Processing

The application uses Core PHP to process visitor photo submissions.

- Maximum 5 photos per submission.
- Maximum 5 MB per photo.
- Accepted formats: JPG, JPEG, PNG and WebP.
- Actual MIME type and image content validation.
- Randomly generated filenames.
- Visitor identification through normalized email addresses.
- PDO prepared statements for database operations.
- MySQL transactions for photo record insertion.
- Consent is recorded for each uploaded photo.

## Slideshow

Open the following page on a computer or smart TV:

http://localhost/visitor-photo-slideshow/display.php

The slideshow displays uploaded photographs one at a time,
changes photographs every five seconds, and checks for
new uploads automatically every five seconds.
