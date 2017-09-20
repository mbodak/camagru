// // Grab elements, create settings, etc.
// var video = document.getElementById('video');
//
// // Get access to the camera!
// if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
//     // Not adding `{ audio: true }` since we only want video now
//     navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
//         video.src = window.URL.createObjectURL(stream);
//         video.play();
//     });
// }
// // Elements for taking the snapshot
//
// var canvas = document.getElementById('canvas');
// var context = canvas.getContext('2d');
// video = document.getElementById('video');
//
// // Trigger photo take
// document.getElementById("snap").addEventListener("click", function() {
//     context.drawImage(video, 0, 0, 640, 480);
// });


//направляем поток из getUserMedia в video
var video = document.querySelector("#video"),
    canvas = document.querySelector('#canvas'),
    ctx = canvas.getContext('2d'),
    localMediaStream = null,
    onCameraFail = function (e) {
        console.log('Camera did not work.', e); // Исключение на случай, если камера не работает
    };
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia({video: true}, function(stream) {
    video.src = window.URL.createObjectURL(stream);
    localMediaStream = stream;
}, onCameraFail);


//таймер, изображение постоянно копируется в canvas
cameraInterval = setInterval(function() { snapshot();}, 1);
function snapshot() {
    if(localMediaStream){
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
}

//подстраиваем высоту блока tools по высоту video
