# Visitor Photo Slideshow

A simple web application that allows visitors to upload their photographs and view them in an automatic slideshow. Each visitor can see only their own uploaded photographs.

## 1. Project Overview

The Visitor Photo Slideshow is a college practical assignment developed using Core PHP, HTML, CSS, JavaScript and MySQL.

The application collects a visitor's name, email address and photographs. It stores visitor information and photo details in a MySQL database and saves the actual image files in the server's uploads directory.

When a visitor uploads photographs, the application displays a slideshow containing only the photographs associated with that visitor.

If the same visitor visits again using the same email address, their previously uploaded photographs remain available along with the newly uploaded photographs.

## 2. Objectives

- Collect visitor details and photographs.
- Identify returning visitors using their email address.
- Store visitor information and photo details in MySQL.
- Display photographs in an automatic slideshow.
- Ensure each visitor sees only their own photographs.
- Allow visitors to return to the upload page easily.

## 3. Technology Stack

| Component | Technology |
|---|---|
| Backend | Core PHP 8 or later |
| Frontend | HTML, CSS, JavaScript |
| Database | MySQL |
| Local development | XAMPP |
| Database connectivity | PHP PDO |
| Version control | Git and GitHub |

No Laravel, React, Node.js, Python or other application frameworks are used.

## 4. Main Features

### Visitor Information

- Collects visitor name and email address.
- Uses email address as the unique visitor identifier.
- Reuses an existing visitor record when the same email is submitted again.

### Photo Upload

- Supports JPG, JPEG, PNG and WebP images.
- Allows 1–5 photographs per submission.
- Maximum file size is 5 MB per photograph.
- Validates image MIME type and actual image content on the server.
- Generates unique filenames for uploaded photographs.
- Requires visitor consent before uploading photographs.

### Visitor-Specific Slideshow

- Displays only the photographs belonging to the current visitor.
- Uses PHP sessions to maintain the visitor ID after a successful upload.
- Retrieves photographs from the database using the visitor ID.
- Automatically changes photographs every 2 seconds.
- Checks for newly uploaded photographs every 5 seconds.
- Provides Pause and Play controls.
- Includes a photo counter.
- Displays images without cropping them.

### Returning Visitors

When an existing visitor submits the same email address again:

- The existing visitor record is reused.
- Previously uploaded photographs are retained.
- Newly uploaded photographs are added.
- The slideshow displays both old and new photographs belonging to that visitor.

### Navigation

- Provides a Back to Home link on the slideshow page.
- Does not require a separate login or logout system.

## 5. Application Workflow

1. The visitor opens the upload page.
2. The visitor enters their name and email address.
3. The visitor selects photographs and provides consent.
4. The server validates the submitted information and photographs.
5. The application creates a new visitor record or identifies an existing visitor using the email address.
6. Photograph files are saved in the uploads directory.
7. Photograph details are inserted into the database with the corresponding visitor ID.
8. The visitor ID is stored in the PHP session.
9. The visitor is redirected to the slideshow page.
10. The slideshow API retrieves only that visitor's photographs.
11. The slideshow automatically displays the photographs.

## 6. Visitor Identification and Privacy

The application uses email addresses to identify returning visitors and PHP sessions to remember the visitor ID during the current browser session.

The slideshow API does not accept a visitor ID from the browser. It obtains the ID from the server-side PHP session and uses it in a prepared SQL query.

This prevents the slideshow API from returning photographs belonging to other visitor IDs.

**Important:** This is session-based visitor identification, not full account authentication. There are no passwords, registered accounts, login or logout features. A person who knows another visitor's email address could submit an upload using that address. The application is designed as a simple college practical assignment, not a production-grade identity system.

## 7. Database Design

The application uses two MySQL tables.

### visitors

Stores visitor information.

| Column | Description |
|---|---|
| visitor_id | Primary key |
| name | Visitor name |
| email | Unique visitor email |
| created_at | Record creation time |
| updated_at | Last update time |

### photos

Stores photograph metadata.

| Column | Description |
|---|---|
| photo_id | Primary key |
| visitor_id | Foreign key referencing visitors |
| stored_filename | Unique image filename |
| mime_type | Image MIME type |
| file_size_bytes | Image size |
| consent_given | Consent status |
| consent_at | Consent timestamp |
| uploaded_at | Upload timestamp |

Each photograph is associated with a visitor through `visitor_id`.

The actual photograph files are stored in the `uploads/` directory. The database stores their filenames and related information.

## 8. Project Structure

```text
visitor-photo-slideshow/
│
├── index.php
├── upload.php
├── display.php
├── .htaccess
│
├── config/
│   ├── env.php
│   ├── database.php
│   └── .htaccess
│
├── api/
│   └── slideshow-photos.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       ├── upload.js
│       └── slideshow.js
│
├── uploads/
│   ├── .htaccess
│   └── .gitkeep
│
├── database/
│   ├── schema.sql
│   └── .htaccess
│
├── tests/
│   └── MANUAL_TEST_PLAN.md
│
├── .env.example
├── .gitignore
├── README.md
├── ASSUMPTIONS.md
├── AI_LOG.md
└── ARCHITECTURE.md
```

## 9. Installation and Setup

### Requirements

- XAMPP
- PHP 8 or later
- MySQL
- Web browser
- Git

### Step 1: Clone the Repository

Clone the project into the XAMPP `htdocs` directory.

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```

The project folder should be:

```text
C:\xampp\htdocs\visitor-photo-slideshow
```

### Step 2: Start XAMPP

Open the XAMPP Control Panel and start:

- Apache
- MySQL

### Step 3: Create the Database

1. Open phpMyAdmin.
2. Import the `database/schema.sql` file.
3. Confirm that the `visitor_slideshow` database has been created.
4. Confirm that the `visitors` and `photos` tables exist.

### Step 4: Configure Environment Variables

Create a `.env` file in the project root directory.

Use the following local development configuration:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=visitor_slideshow
DB_USER=root
DB_PASS=
```

Adjust the values if your local MySQL configuration is different.

The `.env` file is excluded from Git. Only `.env.example` is included in the repository.

### Step 5: Check the Upload Directory

Ensure the following directory exists and is writable by PHP:

```text
uploads/
```

### Step 6: Open the Application

Visit:

```text
http://localhost/visitor-photo-slideshow/
```

The visitor upload page should appear.

## 10. Security Measures

The application includes the following basic security measures:

- PDO database connectivity.
- Prepared statements for database operations.
- Server-side input validation.
- Server-side image MIME validation.
- Actual image content validation.
- Maximum file size and upload count restrictions.
- Unique filenames for uploaded photographs.
- PHP session-based visitor identification.
- Visitor-specific photo retrieval.
- Protection for configuration and database files using `.htaccess`.
- Directory listing disabled.
- Uploaded PHP-like files blocked through upload-directory configuration.
- Visitor email addresses are not returned by the slideshow API.

## 11. Testing

The application should be tested for:

- New visitor registration through photo upload.
- Returning visitor identification using the same email.
- Multiple photographs in one submission.
- Invalid file types.
- Files exceeding the maximum size.
- More than five photographs in one submission.
- Missing consent.
- Separate visitors using separate browser sessions.
- Visitor-specific slideshow results.
- Automatic slideshow playback.
- Pause and Play functionality.
- Back to Home navigation.
- Automatic detection of newly uploaded photographs.

See `tests/MANUAL_TEST_PLAN.md` for the detailed test cases and their results.

## 12. Data Storage and Retention

Visitor records and photograph metadata are stored in MySQL. Photograph files are stored in the `uploads/` directory.

Photographs remain stored until an administrator manually removes them. The project does not include an administrator dashboard or automatic deletion system.

## 13. Limitations

- No user account or password system.
- No login or logout functionality.
- No administrator dashboard.
- No automatic photo deletion.
- Designed for local demonstration using XAMPP.
- Session-based visitor identification is not equivalent to secure account authentication.

## 14. Conclusion

The Visitor Photo Slideshow demonstrates how Core PHP, MySQL, HTML, CSS and JavaScript can be combined to create a simple photo-upload and slideshow application.

It supports new and returning visitors, stores photographs with visitor associations, and displays each visitor's own photographs through a session-based slideshow.