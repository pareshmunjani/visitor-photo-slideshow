# Assumptions and Project Decisions

## 1. General Assumptions

1. The application is developed as a short academic practical assignment.
2. The application uses Core PHP 8+, HTML, CSS, JavaScript and MySQL.
3. XAMPP is used for local development.
4. No additional backend or frontend frameworks are required.
5. All visitors' photographs are displayed in one shared slideshow.

## 2. Visitor Identification

1. Every visitor must provide their name and email address.
2. Email address is the unique identifier for a visitor.
3. Email addresses are trimmed and converted to lowercase before database operations.
4. If the email address already exists, the existing visitor record is reused.
5. When a returning visitor submits a different name, the visitor record is updated with the latest submitted name.

## 3. Photo Upload Rules

1. Each submission must contain at least one photograph.
2. A maximum of five photographs is allowed per submission.
3. The maximum permitted size is 5 MB per photograph.
4. Allowed formats are JPG, JPEG, PNG and WebP.
5. The server validates actual MIME type and image content.
6. Each uploaded photograph receives a unique filename.
7. All photographs in a submission are validated before any are moved into permanent storage.
8. If database processing fails, the database transaction is rolled back and already moved files are cleaned up where possible.

## 4. Returning Visitor Behaviour

1. Returning visitors are identified using their existing email address.
2. Previous photographs are not replaced when new photographs are uploaded.
3. New photographs are inserted as additional photo records.
4. There is no lifetime limit on the number of photographs a visitor can upload.
5. The five-photo limit applies independently to every submission.

## 5. Consent and Privacy

1. Visitors must provide consent before submitting photographs.
2. Consent is recorded for each uploaded photograph.
3. The shared slideshow displays submitted photographs publicly to viewers of the display page.
4. Visitor email addresses are not displayed in the slideshow.
5. Photographs remain stored until an administrator manually removes them.
6. No automatic photo deletion system is included.

## 6. Slideshow Behaviour

1. All visitors' photographs appear in one shared slideshow.
2. The slideshow is accessible through `display.php`.
3. Photographs change automatically every two seconds.
4. The application checks for newly uploaded photographs every five seconds.
5. The slideshow includes Pause and Play controls.
6. The complete photograph is displayed without cropping.
7. Newly uploaded photographs are added to the shared collection automatically.

## 7. Application Usage Modes

### Phone Upload and TV Display

- The TV or computer opens `display.php`.
- Visitors submit photographs from their phones using `index.php`.
- The shared slideshow detects new photographs without requiring a manual refresh.

### Same-Computer Usage

- Visitors submit photographs using `index.php`.
- After a successful submission, the browser automatically redirects to `display.php`.
- The slideshow displays the shared collection.

## 8. Administrator Scope

1. No administrator dashboard is included.
2. Administrators can manually remove photographs from the server and their corresponding database records.
3. Photo retention is manual.
4. No visitor account login or password system is included.

## 9. Database Assumptions

1. The application uses two database tables: `visitors` and `photos`.
2. One visitor can have multiple photographs.
3. The `photos.visitor_id` column references `visitors.visitor_id`.
4. Actual photograph files are stored in the `uploads` directory.
5. MySQL stores photograph filenames and metadata rather than image binary data.

## 10. Scope Limitations

The application does not include:

- An administrator dashboard.
- Cloud image storage.
- Automatic photo deletion.
- External APIs.
- User authentication and password management.
- Advanced image editing.
- Multiple independent slideshow screens or private visitor galleries.

These features are outside the scope of this short academic assignment.