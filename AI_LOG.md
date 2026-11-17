# AI Interaction Log – Visitor Photo Slideshow

## 1. Purpose

This document records important ways AI assistance was used during the development of the Visitor Photo Slideshow college practical assignment.

AI was used as a development assistant for understanding requirements, planning the application, writing and reviewing code, troubleshooting errors, improving the interface and preparing project documentation.

The application was implemented and tested by the student using the local XAMPP environment.

## 2. AI-Assisted Development Activities

### Interaction 1: Understanding the Assignment

**Task:** Understand the Visitor Photo Slideshow assignment requirements.

**AI assistance:**
- Reviewed the assignment objective.
- Identified the main application features.
- Helped distinguish the short college practical assignment from a large commercial project.
- Helped define a simple implementation scope.

**Outcome:** A clear project requirement and feature list was established.

### Interaction 2: Selecting the Technology Stack

**Task:** Finalize suitable technologies for the assignment.

**AI assistance:**
- Compared the project requirements with possible technologies.
- Helped finalize Core PHP, HTML, CSS, JavaScript, MySQL and XAMPP.
- Recommended PDO and prepared statements for database operations.
- Avoided unnecessary frameworks and technologies.

**Outcome:** A simple technology stack suitable for the practical assignment was finalized.

### Interaction 3: Project Structure and Database Design

**Task:** Plan the project folders and database.

**AI assistance:**
- Suggested a structured project directory.
- Designed the `visitors` and `photos` database tables.
- Explained the relationship between visitors and photographs.
- Helped define the use of unique visitor email addresses and photo metadata.

**Outcome:** The project structure and two-table database design were established.

### Interaction 4: Database Connection

**Task:** Configure the PHP application to connect to MySQL.

**AI assistance:**
- Helped create the environment configuration loader.
- Helped configure the PDO database connection.
- Explained PDO exception handling and prepared statements.
- Helped troubleshoot database connection issues.

**Outcome:** The application successfully connected to the MySQL database through PDO.

### Interaction 5: Visitor Upload Form

**Task:** Build the visitor photo-upload interface.

**AI assistance:**
- Helped create the visitor form using HTML and PHP.
- Added name, email, photograph selection and consent fields.
- Helped implement client-side image previews and validation.
- Helped improve the form's visual appearance using CSS.

**Outcome:** The visitor upload form was created and tested.

### Interaction 6: Secure Photo Upload Processing

**Task:** Implement server-side photograph upload handling.

**AI assistance:**
- Helped implement server-side input validation.
- Added image MIME type and image-content checks.
- Added file-size and upload-count restrictions.
- Implemented unique filenames.
- Used PDO prepared statements and database transactions.
- Added cleanup of files when database processing fails.

**Outcome:** The application could validate and store supported photographs.

### Interaction 7: Slideshow Implementation

**Task:** Create an automatic photograph slideshow.

**AI assistance:**
- Helped develop the slideshow display page.
- Helped implement the slideshow API.
- Added automatic playback, Pause and Play controls.
- Added periodic checks for newly uploaded photographs.
- Helped improve image fitting, text contrast and layout styling.

**Outcome:** The slideshow interface and automatic playback functionality were implemented.

### Interaction 8: Troubleshooting and Code Improvements

**Task:** Resolve development issues and improve implementation quality.

**AI assistance:**
- Helped troubleshoot upload-directory naming issues.
- Helped review PHP validation and error handling.
- Helped correct slideshow layout and styling issues.
- Recommended keeping code compatible with the selected PHP version.
- Helped prepare security checks for protected configuration and upload directories.

**Outcome:** Several implementation and interface issues were corrected during development.

### Interaction 9: Visitor-Specific Slideshow Correction

**Task:** Correct the behaviour where photographs from multiple visitors appeared in the same slideshow.

**Problem identified:**

The initial slideshow API retrieved every photograph from the `photos` table without filtering by visitor ID. As a result, photographs belonging to different visitors appeared together.

The application also did not provide a clear way to return to the upload page.

**AI assistance:**
- Reviewed `upload.php`, `display.php` and `api/slideshow-photos.php`.
- Identified that the visitor ID was not stored in the PHP session after upload.
- Recommended storing the visitor ID in the session after a successful database transaction.
- Updated the slideshow page to check for a valid visitor session.
- Updated the API to retrieve photographs using a prepared SQL query with a visitor ID condition.
- Added a Back to Home link.
- Kept the implementation simple without adding login, logout or password functionality.

**Outcome:**

The student implemented the changes and confirmed that the visitor-specific slideshow was working.

Each visitor now sees only photographs associated with their visitor ID in the current PHP session.

### Interaction 10: Project Documentation

**Task:** Prepare and update project documentation.

**AI assistance:**
- Helped prepare the README.
- Helped document the system architecture and database relationship.
- Helped record project assumptions and design decisions.
- Helped prepare a manual testing plan.
- Helped maintain this AI interaction log.

**Outcome:** Project documentation was prepared for the GitHub repository and updated to reflect visitor-specific slideshow behaviour.

## 3. Important Development Corrections

The following corrections were made during development:

| Issue | Correction |
|---|---|
| Upload directory was unavailable | Corrected the directory name to `uploads` |
| Initial database connection issues | Reviewed XAMPP and PDO configuration |
| Photo display layout was not suitable | Improved slideshow CSS and image fitting |
| All visitors' photos appeared together | Added PHP session-based visitor identification and visitor-specific SQL filtering |
| No clear return navigation | Added Back to Home link |

## 4. Final AI Usage Summary

AI assistance was used for:

- Requirement analysis.
- Technology selection.
- Project structure planning.
- Database design.
- PHP code development.
- Frontend styling.
- JavaScript functionality.
- Error troubleshooting.
- Security and validation improvements.
- Documentation preparation.

The student reviewed, implemented and tested the suggested changes in the local development environment.

This log summarizes the important AI-assisted development activities and is not intended to represent a complete transcript of every conversation.