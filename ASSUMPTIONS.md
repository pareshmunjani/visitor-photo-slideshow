# Project Assumptions and Design Decisions

## 1. Project Scope

1. This application is a short college practical assignment, not a commercial product.
2. The implementation should remain simple, functional, clean and easy for a student to understand and demonstrate.
3. Core PHP 8 or later is used for backend development.
4. HTML, CSS and JavaScript are used for the frontend.
5. MySQL is used as the database.
6. XAMPP is used for local development.
7. PHP PDO and prepared statements are used for database operations.
8. Unnecessary frameworks and technologies are not included.

## 2. Visitor Identification

1. Every visitor must enter their name and email address before uploading photographs.
2. Email address is the unique identifier used to recognize returning visitors.
3. Email addresses are trimmed and converted to lowercase before database operations.
4. If an email address already exists, the existing visitor record is reused.
5. If an email address does not exist, a new visitor record is created.
6. The latest submitted visitor name may update the existing visitor record.
7. Email addresses are not displayed in the slideshow or returned by the slideshow API.

## 3. Visitor-Specific Slideshow

1. Each visitor must see only their own uploaded photographs.
2. Photographs belonging to other visitors must not appear in the current visitor's slideshow.
3. The slideshow API retrieves photographs using the current visitor ID stored in the PHP session.
4. The visitor ID must be obtained from the server-side session, not from a URL parameter or JavaScript input.
5. A visitor without a valid visitor session must be redirected from `display.php` to the upload page.
6. The slideshow API must return an unauthorized response when no valid visitor session exists.
7. The application does not provide a separate global slideshow containing everyone's photographs.
8. A returning visitor sees all their previously uploaded photographs along with their newly uploaded photographs.
9. The slideshow includes a Back to Home link to return to the upload page.

## 4. Session and Authentication Decisions

1. PHP sessions are used to maintain the visitor ID after a successful upload.
2. The session is started in the upload processing, slideshow display and slideshow API requests.
3. The visitor ID is stored in the session only after the database transaction succeeds.
4. The application does not implement user accounts.
5. There are no passwords, login or logout features.
6. The Back to Home link is navigation, not a logout operation.
7. Session-based identification is not equivalent to secure account authentication.
8. The application does not verify that a visitor owns the email address they submit. Someone who knows another person's email address could submit an upload using it.

## 5. Photo Upload Rules

1. A visitor can upload between 1 and 5 photographs per submission.
2. The limit of 5 photographs applies to each submission, not to the visitor's lifetime uploads.
3. A returning visitor can upload additional photographs in future submissions.
4. Previously uploaded photographs must not be deleted when new photographs are uploaded.
5. Each photograph must be no larger than 5 MB.
6. Supported image formats are JPG/JPEG, PNG and WebP.
7. The server validates the actual MIME type and image content.
8. Each stored photograph receives a unique generated filename.
9. The visitor must provide consent before uploading photographs for display.
10. Consent information is stored with each photograph record.
11. The complete batch is validated before files are moved into permanent storage.
12. Database changes for an upload are handled using a transaction.

## 6. Photo Storage

1. Actual image files are stored in the project's `uploads/` directory.
2. MySQL stores photo filenames and metadata rather than image binary data.
3. Each photo record is linked to its visitor through `visitor_id`.
4. Unique filenames prevent filename collisions between visitors.
5. The upload directory must not allow directory listing.
6. PHP-like file execution is blocked in the upload directory.

## 7. Slideshow Behaviour

1. One photograph is displayed at a time.
2. The slideshow automatically advances every 2 seconds.
3. The application checks for newly uploaded photographs every 5 seconds.
4. The slideshow provides Pause and Play controls.
5. A photo counter displays the number of photographs available to the current visitor.
6. Images should fit inside the display area without unwanted cropping.
7. The slideshow should handle an empty photo list gracefully.
8. Newly uploaded photographs belonging to the current visitor should appear automatically when the API refreshes.
9. Photographs belonging to other visitors must never be added to the current visitor's slideshow.

## 8. Navigation

1. The upload form is available at `index.php`.
2. Successful uploads redirect to `display.php`.
3. The slideshow page provides a Back to Home link.
4. Visitors can return to the upload page and submit additional photographs.
5. No separate logout page or logout operation is required.

## 9. Database Design

The application uses two tables:

### visitors

- Stores visitor ID, name, email and timestamps.
- Email is unique.
- Visitor ID is the primary key.

### photos

- Stores photo ID, visitor ID, filename, MIME type, file size, consent information and upload timestamp.
- Photo ID is the primary key.
- Visitor ID is a foreign key referencing `visitors`.
- One visitor can have multiple photographs.
- Each photograph belongs to one visitor.

## 10. Data Retention

1. Visitor records and photograph metadata remain in the database until manually removed.
2. Actual photographs remain in the uploads directory until manually removed.
3. The application does not automatically delete old photographs.
4. There is no administrator dashboard.
5. Manual deletion is performed by an administrator through the database and file system.
6. Deleting a visitor record cascades to its photo metadata, but physical image files require separate manual deletion.

## 11. Development and Demonstration

1. The application is developed and tested locally using XAMPP.
2. Apache and MySQL must be running before demonstration.
3. The application is opened through the local server URL.
4. Multiple browser sessions should be used to demonstrate visitor-specific slideshow behaviour.
5. The same email address should be used again to demonstrate returning visitor behaviour.
6. The public GitHub repository should not contain `.env` credentials or uploaded visitor photographs.

## 12. Final Behaviour Summary

The final application follows these rules:

- Each visitor enters their name, email and photographs.
- Email identifies an existing visitor record.
- PHP sessions maintain the current visitor ID after upload.
- Each slideshow displays only the current visitor's photographs.
- Returning visitors retain their old photographs and can add new ones.
- Visitors can return to the upload page using Back to Home.
- No login, logout, password or administrator dashboard is included.
- The project remains a simple and explainable college practical assignment.