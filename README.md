
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

## Using the Application

1. Start Apache and MySQL using XAMPP.
2. Open the visitor upload page:
   http://localhost/visitor-photo-slideshow/

3. Submit visitor details, photos and consent.

4. For a shared TV display, open:
   http://localhost/visitor-photo-slideshow/display.php

5. Alternatively, after uploading, click the View Photo Slideshow
   link to open the display on the same computer.

The slideshow displays one photograph every 2 seconds and
checks for newly uploaded photographs every 5 seconds.
