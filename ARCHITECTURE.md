
## Slideshow Workflow

1. The browser opens display.php.
2. JavaScript requests api/slideshow-photos.php.
3. PHP retrieves all photo records from MySQL.
4. PHP returns photo IDs and image URLs as JSON.
5. JavaScript displays one image at a time.
6. The image changes every five seconds.
7. The endpoint is checked every five seconds for new photographs.
8. Newly uploaded photographs are included without reloading the page.

The slideshow does not retrieve or display visitor email addresses.

## Two Application Usage Modes

### Mode 1: Phone Upload and TV Display

- The TV or computer opens display.php once.
- Visitors access index.php using their phones.
- Uploaded photographs are stored in MySQL and the uploads directory.
- The running slideshow automatically retrieves new photographs.

### Mode 2: Same Computer

- The visitor opens index.php.
- After a successful upload, a slideshow link appears.
- The visitor can open display.php in a new browser tab.

Both modes use the same shared slideshow and database.
