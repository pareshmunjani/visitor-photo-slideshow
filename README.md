
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
