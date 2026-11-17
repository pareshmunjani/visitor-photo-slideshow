
const photoInput = document.getElementById("photos");
const previewArea = document.getElementById("photo-preview");
const errorMessage = document.getElementById("photo-error");

const allowedTypes = [
    "image/jpeg",
    "image/png",
    "image/webp"
];

const maxSize = 5 * 1024 * 1024;

photoInput.addEventListener("change", function () {

    previewArea.innerHTML = "";
    errorMessage.textContent = "";

    const files = Array.from(this.files);

    if (files.length > 5) {
        showError("You can select a maximum of 5 photos.");
        this.value = "";
        return;
    }

    for (const file of files) {

        if (!allowedTypes.includes(file.type)) {
            showError("Only JPG, JPEG, PNG and WebP images are allowed.");
            this.value = "";
            previewArea.innerHTML = "";
            return;
        }

        if (file.size > maxSize) {
            showError("Each photo must be 5 MB or smaller.");
            this.value = "";
            previewArea.innerHTML = "";
            return;
        }
    }

    files.forEach(function (file) {

        const image = document.createElement("img");

        const imageUrl = URL.createObjectURL(file);

        image.src = imageUrl;
        image.alt = "Selected photo preview";

        image.onload = function () {
            URL.revokeObjectURL(imageUrl);
        };

        previewArea.appendChild(image);

    });

});

function showError(message) {
    errorMessage.textContent = message;
}
