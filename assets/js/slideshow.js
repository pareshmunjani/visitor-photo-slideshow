
const API_URL = "api/slideshow-photos.php";

const SLIDE_DURATION = 2000;
const REFRESH_INTERVAL = 5000;

const imageElement = document.getElementById("slideshow-image");
const photoStage = document.getElementById("photo-stage");
const waitingMessage = document.getElementById("waiting-message");
const photoCounter = document.getElementById("photo-counter");

const pausePlayButton = document.getElementById("pause-play-button");
const playbackStatus = document.getElementById("playback-status");

let photos = [];
let currentIndex = -1;
let currentPhotoId = null;

let isPaused = false;
let isChanging = false;
let pendingIndex = null;


// Pause and Play button
pausePlayButton.addEventListener("click", () => {

    isPaused = !isPaused;

    pausePlayButton.textContent = isPaused ? "Play" : "Pause";

    playbackStatus.textContent = isPaused ? "Paused" : "Playing";

});


// Retrieve photographs from PHP
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

        if (photos.length === 0) {

            photoStage.classList.add("hidden");
            waitingMessage.classList.remove("hidden");

            currentIndex = -1;
            currentPhotoId = null;

            pausePlayButton.disabled = true;
            playbackStatus.textContent = "Waiting for photos";

            return;
        }

        pausePlayButton.disabled = false;

        // Keep the currently displayed photo if it still exists.
        const existingIndex = photos.findIndex(
            photo => photo.id === currentPhotoId
        );

        if (existingIndex !== -1) {

            currentIndex = existingIndex;

        } else if (!isChanging) {

            // If the current photo no longer exists, show the first one.
            showPhoto(0);

        }

        playbackStatus.textContent = isPaused ? "Paused" : "Playing";

    } catch (error) {

        console.error("Slideshow error:", error);

        // Keep the currently displayed image visible if the API fails.

    }

}


// Display a photograph
function showPhoto(index) {

    if (photos.length === 0 || isChanging) {
        pendingIndex = index;
        return;
    }

    index = (index + photos.length) % photos.length;

    const selectedPhoto = photos[index];

    isChanging = true;
    pendingIndex = null;

    const newImage = new Image();

    newImage.onload = function () {

        imageElement.src = selectedPhoto.image_url;

        currentIndex = index;
        currentPhotoId = selectedPhoto.id;

        waitingMessage.classList.add("hidden");
        photoStage.classList.remove("hidden");

        isChanging = false;

        // Process a pending request if one arrived during loading.
        if (pendingIndex !== null) {
            const nextIndex = pendingIndex;
            pendingIndex = null;
            showPhoto(nextIndex);
        }

    };

    newImage.onerror = function () {

        console.error("Unable to load slideshow image.");

        isChanging = false;

        if (pendingIndex !== null) {
            const nextIndex = pendingIndex;
            pendingIndex = null;
            showPhoto(nextIndex);
        }

    };

    newImage.src = selectedPhoto.image_url;

}


// Automatically move to the next photograph
function nextPhoto() {

    if (isPaused || photos.length <= 1) {
        return;
    }

    showPhoto(currentIndex + 1);

}


// Start slideshow
loadPhotos();


// Change photograph every 2 seconds
setInterval(nextPhoto, SLIDE_DURATION);


// Check for new photographs every 5 seconds
setInterval(loadPhotos, REFRESH_INTERVAL);
