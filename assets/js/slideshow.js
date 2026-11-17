
const API_URL = "api/slideshow-photos.php";

const SLIDE_DURATION = 2000;
const REFRESH_INTERVAL = 2000;

const imageElement = document.getElementById("slideshow-image");
const photoStage = document.getElementById("photo-stage");

const waitingMessage = document.getElementById("waiting-message");
const photoCounter = document.getElementById("photo-counter");

let photos = [];
let currentIndex = -1;

let currentPhotoId = null;
let isChanging = false;

// Retrieve photographs from PHP.
async function loadPhotos() {

    try {

        const response = await fetch(API_URL, {
            cache: "no-store"
        });

        if (!response.ok) {
            throw new Error("Unable to retrieve photos.");
        }

        const data = await response.json();

        if (!data.success) {
            throw new Error("Photo retrieval failed.");
        }

        photos = data.photos;

        photoCounter.textContent =
            photos.length + (photos.length === 1 ? " PHOTO" : " PHOTOS");

        // Show waiting screen when no photos exist.
        if (photos.length === 0) {

            photoStage.classList.add("hidden");
            waitingMessage.classList.remove("hidden");

            currentIndex = -1;
            currentPhotoId = null;

            return;
        }

        // Preserve the currently displayed photograph.
        if (currentPhotoId !== null) {

            const existingIndex = photos.findIndex(
                photo => photo.id === currentPhotoId
            );

            currentIndex = existingIndex;

        }

        // Display the first photo when starting.
        if (currentIndex === -1) {
            showPhoto(0);
        }

    } catch (error) {

        console.error("Slideshow error:", error);

    }
}


// Display a photograph.
function showPhoto(index) {

    if (photos.length === 0 || isChanging) {
        return;
    }

    index = (index + photos.length) % photos.length;

    const selectedPhoto = photos[index];

    isChanging = true;

    waitingMessage.classList.add("hidden");
    photoStage.classList.remove("hidden");

    imageElement.classList.add("changing");

    const newImage = new Image();

    newImage.onload = function () {

        imageElement.src = selectedPhoto.image_url;

        currentIndex = index;
        currentPhotoId = selectedPhoto.id;

        imageElement.classList.remove("changing");

        isChanging = false;

    };

    newImage.onerror = function () {

        console.error("Unable to load slideshow image.");

        imageElement.classList.remove("changing");

        isChanging = false;

    };

    newImage.src = selectedPhoto.image_url;

}


// Move to the next photograph.
function nextPhoto() {

    if (photos.length <= 1) {
        return;
    }

    showPhoto(currentIndex + 1);

}


// Start slideshow.
loadPhotos();


// Change image every five seconds.
setInterval(nextPhoto, SLIDE_DURATION);


// Check for newly uploaded photographs every five seconds.
setInterval(loadPhotos, REFRESH_INTERVAL);
