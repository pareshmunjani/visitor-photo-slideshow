# Manual Test Plan – Visitor Photo Slideshow

## 1. Testing Information

**Project:** Visitor Photo Slideshow  
**Testing Environment:** Windows, XAMPP  
**Backend:** Core PHP 8+  
**Database:** MySQL  
**Browser:** Web browser on local development environment

Testing is performed manually through the application interface and browser.

## 2. Visitor Registration and Identification

| ID | Test Case | Expected Result | Status |
|---|---|---|---|
| TC-01 | Submit a new visitor's name and email | Visitor record is created | PASS |
| TC-02 | Upload photographs for a new visitor | Photographs are saved successfully | PASS |
| TC-03 | Submit again using an existing email | Existing visitor is identified | PASS |
| TC-04 | Returning visitor uploads additional photographs | New photographs are added | PASS |
| TC-05 | Check previously uploaded photographs | Previous photographs remain available | PASS |

## 3. Photo Upload Validation

| ID | Test Case | Expected Result | Status |
|---|---|---|---|
| TC-06 | Upload a valid JPG image | Accepted | PASS |
| TC-07 | Upload a valid PNG image | Accepted | PASS |
| TC-08 | Upload a valid WebP image | Accepted | PASS |
| TC-09 | Upload a PDF renamed with `.jpg` extension | Rejected | PASS |
| TC-10 | Upload a photograph larger than 5 MB | Rejected | PASS |
| TC-11 | Submit six photographs together | Rejected | PASS |
| TC-12 | Submit without photo-display consent | Rejected | PASS |

## 4. Slideshow Testing

| ID | Test Case | Expected Result | Status |
|---|---|---|---|
| TC-13 | Open the slideshow page | Slideshow page loads | PENDING |
| TC-14 | Display multiple photographs | Photographs appear in sequence | PENDING |
| TC-15 | Check automatic slide duration | Changes every 2 seconds | PENDING |
| TC-16 | Click Pause | Automatic photo changes stop | PENDING |
| TC-17 | Click Play | Automatic photo changes resume | PENDING |
| TC-18 | Upload a new photograph while slideshow is open | New photograph appears automatically | PENDING |
| TC-19 | Open slideshow with no photographs | Waiting message appears | PENDING |
| TC-20 | Check photo counter | Counter shows total photographs | PENDING |
| TC-21 | Check successful upload redirect | Browser opens slideshow automatically | PENDING |
| TC-22 | Check slideshow image layout | Complete photograph is visible without cropping | PENDING |

## 5. Security Testing

| ID | Test Case | Expected Result | Status |
|---|---|---|---|
| TC-23 | Open root `.env` directly in browser | Access forbidden | PASS |
| TC-24 | Open `config/database.php` directly | Access forbidden | PASS |
| TC-25 | Open `config/env.php` directly | Access forbidden | PASS |
| TC-26 | Open `database/schema.sql` directly | Access forbidden | PASS |
| TC-27 | Open the `uploads` directory | Directory listing forbidden | PASS |

## 6. Additional Security Checks

| ID | Test Case | Expected Result | Status |
|---|---|---|---|
| TC-28 | Attempt to execute a PHP file inside uploads | Execution blocked | PENDING |
| TC-29 | Submit a very long visitor name | Rejected | PENDING |
| TC-30 | Test simultaneous submissions using the same email | Both submissions handled correctly | PENDING |

## 7. Testing Notes

- PASS means the test was performed and the expected result was observed.
- FAIL means the test was performed but the expected result was not observed.
- PENDING means the test has not yet been verified.
- Tests should be updated only after actual execution.
- Security configuration should be checked in the local Apache environment.

## 8. Testing Summary

The application has been tested for visitor registration, returning-visitor identification, photograph uploads, invalid upload rejection and direct-access protection.

Slideshow-specific tests and remaining security checks must be completed and their results recorded before final submission.

## 9. Conclusion

Manual testing helps verify that the Visitor Photo Slideshow application behaves according to its finalized requirements.

The test plan is maintained to document functional behaviour, upload validation, slideshow controls and basic application security.