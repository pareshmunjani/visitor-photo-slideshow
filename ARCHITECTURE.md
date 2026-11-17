
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
