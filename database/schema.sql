
CREATE DATABASE IF NOT EXISTS visitor_slideshow
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE visitor_slideshow;

-- Table 1: Visitors
CREATE TABLE visitors (
    visitor_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(254) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Table 2: Photos
CREATE TABLE photos (
    photo_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT UNSIGNED NOT NULL,
    stored_filename VARCHAR(100) NOT NULL UNIQUE,
    mime_type VARCHAR(40) NOT NULL,
    file_size_bytes INT UNSIGNED NOT NULL,
    consent_given TINYINT(1) NOT NULL,
    consent_at DATETIME NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_photos_visitors
        FOREIGN KEY (visitor_id)
        REFERENCES visitors(visitor_id)
        ON DELETE CASCADE,

    INDEX idx_photos_visitor_id (visitor_id),
    INDEX idx_photos_uploaded_at (uploaded_at)
) ENGINE=InnoDB;
