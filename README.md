# Visitor Photo Slideshow

A simple web application that collects photographs from visitors and automatically displays them in a shared slideshow.

## 1. Project Overview

The Visitor Photo Slideshow application allows visitors to submit their name, email address and photographs.

Uploaded photographs are stored on the server and displayed automatically on a shared slideshow screen.

When an existing visitor returns, the application identifies them using their email address. Their previously uploaded photographs remain available, and newly submitted photographs are added to the existing collection.

## 2. Objectives

- Collect visitor information and photographs.
- Identify returning visitors using their email address.
- Retain previously uploaded photographs.
- Display all visitors' photographs in one shared slideshow.
- Automatically detect newly uploaded photographs.
- Provide Pause and Play controls for the slideshow.

## 3. Technology Stack

| Component | Technology |
|---|---|
| Backend | Core PHP 8+ |
| Frontend | HTML, CSS, JavaScript |
| Database | MySQL |
| Local server | XAMPP |
| Database access | PHP PDO |
| Version control | Git and GitHub |

No additional frameworks are required.

## 4. Main Features

### Visitor Registration and Identification
- Visitors enter their name and email address.
- Email addresses are trimmed and converted to lowercase.
- Email address is used to identify returning visitors.
- Returning visitors reuse their existing visitor record.

### Photo Upload
- A visitor can upload 1–5 photographs per submission.
- Maximum file size is 5 MB per photograph.
- Supported formats: JPG, JPEG, PNG and WebP.
- Server-side validation checks actual MIME type and image content.
- Uploaded files receive unique filenames.
- Visitor consent is required before photographs are submitted.

### Shared Photo Slideshow
- Displays photographs uploaded by all visitors.
- Automatically changes photographs every 2 seconds.
- Checks for newly uploaded photographs every 5 seconds.
- Provides Pause and Play controls.
- Keeps the complete photograph visible without cropping.

### Returning Visitors
- Previous photographs are retained.
- New photographs are added to the existing collection.
- The 5-photo limit applies to each submission, not to the visitor's lifetime total.

### Two Usage Modes

**Mode 1: Phone Upload and TV Display**

1. Open the slideshow page on a TV or computer.
2. Visitors open the upload page on their phones.
3. Visitors submit their photographs.
4. New photographs appear automatically on the shared display.

**Mode 2: Same Computer**

1. A visitor submits photographs using the upload page.
2. After successful submission, the browser automatically redirects to the slideshow.
3. The slideshow displays the shared collection.

## 5. Project Structure

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
├── ARCHITECTURE.md
├── ASSUMPTIONS.md
└── AI_LOG.md
```

## 6. Installation and Setup

### Requirements

- XAMPP
- PHP 8 or later
- MySQL
- Web browser
- Git

### Step 1: Clone the repository

```bash
git clone YOUR_GITHUB_REPOSITORY_URL
```

Place the project folder inside:

```text
C:\xampp\htdocs\
```

### Step 2: Start XAMPP

Start Apache and MySQL using the XAMPP Control Panel.

### Step 3: Create the database

1. Open phpMyAdmin.
2. Import `database/schema.sql`.
3. The database and required tables will be created.

Database name:

```text
visitor_slideshow
```

### Step 4: Configure environment variables

Copy `.env.example` to `.env` in the project root.

Configure the database details:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=visitor_slideshow
DB_USER=root
DB_PASS=
```

Use the correct password if your local MySQL installation has one.

Do not commit `.env` to GitHub.

### Step 5: Check upload directory

Ensure the `uploads` directory exists and is writable by PHP.

### Step 6: Open the application

Visitor upload page:

```text
http://localhost/visitor-photo-slideshow/
```

Shared slideshow:

```text
http://localhost/visitor-photo-slideshow/display.php
```

## 7. Database Design

The application uses two database tables:

- `visitors` – stores visitor names and email addresses.
- `photos` – stores photograph filenames, metadata, consent and visitor references.

Photograph files are stored in the `uploads` directory. MySQL stores their filenames and related information.

See `ARCHITECTURE.md` for the database structure.

## 8. Security Measures

- PDO prepared statements for database operations.
- Server-side file type and image-content validation.
- Maximum file-size enforcement.
- Randomly generated filenames.
- Visitor consent required for photo submission.
- Uploaded PHP files are blocked from execution through Apache configuration.
- Directory listing is disabled.
- Direct access to environment and configuration files is restricted.
- Technical database errors are logged rather than directly displayed.

## 9. Photo Retention

Uploaded photographs remain available in the shared slideshow until an administrator manually removes them.

There is no automatic deletion or administrative dashboard in this assignment.

## 10. Testing

Manual test cases and their results are maintained in:

```text
tests/MANUAL_TEST_PLAN.md
```

Only tests actually performed should be marked as passed.

## 11. Project Scope

This is a short academic practical assignment demonstrating:

- PHP form handling
- File uploads
- MySQL database operations
- Visitor identification
- JavaScript slideshow functionality
- Basic application security
- Git and GitHub usage

The application is intentionally kept simple and does not include unnecessary frameworks or commercial-scale features.
