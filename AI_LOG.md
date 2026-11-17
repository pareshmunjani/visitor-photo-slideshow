# AI Interaction Log – Visitor Photo Slideshow

## 1. Introduction

AI tools were used during the planning, development, debugging and improvement of the Visitor Photo Slideshow application.

AI assistance helped with understanding requirements, generating code suggestions, troubleshooting errors, improving the user interface and reviewing application security.

The developer reviewed and tested the suggestions before using them in the project.

## 2. Important AI Interactions

### Interaction 1 – Project Planning

**Task:** Understand the assignment requirements and finalize the project approach.

**AI assistance:**
- Helped identify the required application features.
- Suggested a simple project structure.
- Helped finalize Core PHP, HTML, CSS, JavaScript and MySQL.

**Outcome:** A simple technology stack and implementation plan were finalized.

### Interaction 2 – Visitor Identification

**Task:** Design a method to identify returning visitors.

**AI assistance:**
- Suggested using email as the unique visitor identifier.
- Explained how an existing visitor record can be reused.
- Suggested adding new photographs without deleting previous photographs.

**Outcome:** Returning visitors are identified using their email addresses.

### Interaction 3 – Secure Photo Upload

**Task:** Implement photo uploads with server-side validation.

**AI assistance:**
- Helped implement file-size validation.
- Suggested MIME-type verification using PHP Fileinfo.
- Suggested checking actual image content.
- Helped implement unique filenames and database transactions.

**Outcome:** The upload process includes server-side validation and database error handling.

### Interaction 4 – PHP Compatibility Correction

**Task:** Review PHP compatibility for the upload implementation.

**AI suggestion:** An earlier version used the `never` return type for a redirect helper function.

**Issue:** The `never` return type requires PHP 8.1 or later, while the project requirement is PHP 8 or later.

**Correction:** The return type was changed to `void` for PHP 8.0 compatibility.

**Outcome:** The helper function supports the intended PHP 8+ compatibility range.

### Interaction 5 – Slideshow CSS Class Correction

**Task:** Improve the slideshow layout and heading appearance.

**AI suggestion:** An earlier CSS suggestion used the class name `slideshow-header`.

**Issue:** The actual HTML used the class name `slideshow-heading`, so the suggested styling would not target the heading.

**Correction:** The CSS was revised to use the actual class name from the HTML.

**Outcome:** The slideshow heading styling was aligned with the existing page structure.

### Interaction 6 – Slideshow Timing

**Task:** Configure automatic photo changes and detection of newly uploaded photographs.

**AI assistance:**
- Helped configure automatic slideshow transitions.
- Helped separate the slide duration from the photo-refresh interval.

**Outcome:** The finalized settings are:
- Slide duration: 2 seconds.
- Photo refresh interval: 5 seconds.

### Interaction 7 – Slideshow User Interface

**Task:** Improve the slideshow experience.

**AI assistance:**
- Suggested a full-screen layout.
- Helped use `object-fit: contain` to prevent image cropping.
- Helped add Pause and Play controls.
- Suggested improvements to text contrast and layout.

**Outcome:** The slideshow interface was refined for browser and TV display.

### Interaction 8 – Security Review

**Task:** Review application security and configuration protection.

**AI assistance:**
- Reviewed PHP upload validation.
- Reviewed PDO database connection settings.
- Reviewed environment-variable loading.
- Suggested Apache access restrictions for configuration and database folders.

**Outcome:** Security configuration was reviewed and direct-access protection was tested locally.

## 3. AI Usage Summary

AI tools were used as development assistants rather than as a replacement for understanding or testing the application.

The developer reviewed generated code, applied corrections, tested application behaviour and maintained the project using Git and GitHub.

## 4. Limitations

- AI-generated code may contain errors.
- Suggestions must be checked against the actual project files.
- Generated code must be tested in the local environment.
- Security configurations must be verified rather than assumed to work.

## 5. Conclusion

AI assistance helped accelerate the development process, explain programming concepts, identify implementation issues and improve the application.

The final application was developed and tested through an iterative process involving AI suggestions, developer review and practical verification.