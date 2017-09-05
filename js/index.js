function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("invisibleBox").style.display = "block";
    document.getElementById("body").style.overflow = "hidden";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("invisibleBox").style.display = "none";
    document.getElementById("body").style.overflow = "auto";
}

function open_search() {
    document.getElementById("mySearch").style.display = "block";
}

function close_search() {
    document.getElementById("mySearch").style.display = "none";
}




// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
    });
}
// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
    context.drawImage(video, 0, 0, 640, 480);
});