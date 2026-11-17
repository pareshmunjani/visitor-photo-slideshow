# Manual Test Plan – Visitor Photo Slideshow

## 1. Purpose

This document describes the manual testing performed to verify the Visitor Photo Slideshow application.

Testing covers application setup, database connectivity, visitor registration, photograph uploads, returning visitors, visitor-specific slideshow behaviour, slideshow controls, navigation and basic security.

## 2. Test Environment

| Item | Configuration |
|---|---|
| Operating System | Windows |
| Local Server | XAMPP |
| Web Server | Apache |
| Database Server | MySQL |
| Backend | Core PHP 8+ |
| Frontend | HTML, CSS, JavaScript |
| Database | MySQL |
| Browser | Google Chrome |
| Project URL | `http://localhost/visitor-photo-slideshow/` |

## 3. Test Cases and Results

### A. Application and Database

| ID | Test Scenario | Expected Result | Status |
|---|---|---|---|
| TC-01 | Start Apache and MySQL from XAMPP | Both services start successfully | PASS |
| TC-02 | Open the application home page | Visitor upload form appears | PASS |
| TC-03 | Connect PHP application to MySQL through PDO | Database connection succeeds | PASS |

### B. Visitor Information and Photo Upload

| ID | Test Scenario | Expected Result | Status |
|---|---|---|---|
| TC-04 | Submit a new visitor's name, email and two valid photos | Visitor is saved and both photos are uploaded | PASS |
| TC-05 | Submit another upload using the same email address | Existing visitor record is reused | PASS |
| TC-06 | Upload additional photos using the same email | Previous photographs remain stored and new photographs are added | PASS |
| TC-07 | Upload a valid JPG, PNG or WebP image | Image is accepted | PASS |
| TC-08 | Upload a PDF renamed with a `.jpg` extension | Server rejects the file | PASS |
| TC-09 | Upload a photograph larger than 5 MB | Server rejects the file | PASS |
| TC-10 | Select more than five photographs in one submission | Submission is rejected | PASS |
| TC-11 | Submit without accepting the consent checkbox | Submission is rejected | PASS |
| TC-12 | Submit without selecting a photograph | Submission is rejected | PASS |

### C. Visitor-Specific Slideshow

| ID | Test Scenario | Expected Result | Status |
|---|---|---|---|
| TC-13 | Visitor A uploads photographs | Visitor A is redirected to the slideshow | PASS |
| TC-14 | Visitor B uploads photographs using a different email and browser session | Visitor B sees only Visitor B's photographs | PASS |
| TC-15 | Visitor A opens the slideshow again in Visitor A's existing session | Visitor A sees only Visitor A's photographs | PASS |
| TC-16 | Returning visitor uploads additional photographs | The slideshow includes that visitor's previous and newly uploaded photographs | PASS |
| TC-17 | Open the slideshow page without a visitor session | Application redirects to the home page | PASS |
| TC-18 | Request the slideshow API without a visitor session | API returns HTTP 401 Unauthorized | PASS |
| TC-19 | Use the Back to Home link from the slideshow | Visitor returns to the upload form | PASS |

### D. Slideshow Controls

| ID | Test Scenario | Expected Result | Status |
|---|---|---|---|
| TC-20 | Open slideshow with available photographs | Photographs are displayed automatically | PASS |
| TC-21 | Observe slideshow playback | Photographs change at approximately two-second intervals | PASS |
| TC-22 | Click Pause | Automatic playback stops | PASS |
| TC-23 | Click Play | Automatic playback resumes | PASS |
| TC-24 | Observe the photograph counter | Counter displays the number of photographs | PASS |
| TC-25 | Upload another photograph while slideshow is open | New photograph is detected during periodic refresh | PASS |
| TC-26 | Display a portrait photograph | Entire photograph remains visible without unwanted cropping | PASS |

### E. Security and Access Protection

| ID | Test Scenario | Expected Result | Status |
|---|---|---|---|
| TC-27 | Open `/.env` directly in the browser | Access is forbidden | PASS |
| TC-28 | Open `/config/database.php` directly | Access is forbidden | PASS |
| TC-29 | Open `/config/env.php` directly | Access is forbidden | PASS |
| TC-30 | Open `/database/schema.sql` directly | Access is forbidden | PASS |
| TC-31 | Open `/uploads/` directly | Directory listing is forbidden | PASS |
| TC-32 | Attempt to execute a PHP file placed in `uploads/` | PHP execution is blocked | PASS |

## 4. Test Status Legend

- **PASS:** Test was performed and the expected result was observed.
- **FAIL:** Test was performed and the expected result was not observed.

All 32 test cases listed in this document were tested successfully.

## 5. Important Testing Notes

1. Separate browser sessions, such as a normal Chrome window and an Incognito window, were used to test different visitors.
2. Different email addresses were used for different visitors.
3. The same email address was used to test returning visitors.
4. The visitor-specific slideshow uses the PHP session to identify the current visitor.
5. The application stores photograph files in the `uploads/` directory and their metadata in MySQL.
6. The application does not implement full login, password or email-verification functionality.

## 6. Testing Summary

The application successfully passed all 32 manual test cases covering:

- Application and database setup.
- Visitor registration and returning visitors.
- Photograph upload and validation.
- Visitor-specific slideshow functionality.
- Automatic slideshow playback and controls.
- Navigation and session handling.
- Basic security and access protection.

**Final Test Result: 32/32 PASS (100%)**

