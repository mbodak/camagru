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
    context = canvas.getContext('2d'),
    localMediaStream = null,
    onCameraFail = function (e) {
        console.log('Camera did not work.', e); // Исключение на случай, если камера не работает
    };
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia({video: true}, function(stream) {
    video.src = window.URL.createObjectURL(stream);
    video.play();
    localMediaStream = stream;
}, onCameraFail);


//таймер, изображение постоянно копируется в canvas
cameraInterval = setInterval(function() { snapshot();}, 1);
function snapshot() {
    if (localMediaStream) {
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
}
// document.getElementById("snap").addEventListener("click", function() {
//      context.drawImage(video, 0, 0, 640, 480);



function imgDraw(src) {
    var img = document.getElementById("img");
    img.src = src;
}









// var bg = document.getElementById('canvas');
// var bgctx = bg.getContext('2d');
// bgctx.drawImage(document.getElementById('bgimg'), 20, 20);
//
// var image = document.getElementById('logo');
// var img_context = image.getContext('2d');
//
// make_logo();
//
// function make_logo() {
//     logoimage = document.getElementById('logoimg');
//     logoimage.onload = function() {
//         logo_context.drawImage(logoimage, 20, 20);
//     }
// }
//
//
//
// var canvasOffset = $("#logo").offset();
// var offsetX = canvasOffset.left;
// var offsetY = canvasOffset.top;
// var canvasWidth = canvas.width;
// var canvasHeight = canvas.height;
// var isDragging = false;
//
// function handleMouseDown(e) {
//     canMouseX = parseInt(e.clientX - offsetX);
//     canMouseY = parseInt(e.clientY - offsetY);
//     // set the drag flag
//     isDragging = true;
// }
//
// function handleMouseUp(e) {
//     canMouseX = parseInt(e.clientX - offsetX);
//     canMouseY = parseInt(e.clientY - offsetY);
//     // clear the drag flag
//     isDragging = false;
// }
//
// function handleMouseOut(e) {
//     canMouseX = parseInt(e.clientX - offsetX);
//     canMouseY = parseInt(e.clientY - offsetY);
//     // user has left the canvas, so clear the drag flag
//     isDragging = false;
// }
//
// function handleMouseMove(e) {
//     canMouseX = parseInt(e.clientX - offsetX);
//     canMouseY = parseInt(e.clientY - offsetY);
//     // if the drag flag is set, clear the canvas and draw the image
//     if (isDragging) {
//         img_context.clearRect(0, 0, canvasWidth, canvasHeight);
//         img_context.drawImage(logoimage, canMouseX, canMouseY + canvasHeight / 4);
//     }
// }
//
// $("#logo").mousedown(function(e) {
//     handleMouseDown(e);
// });
// $("#logo").mousemove(function(e) {
//     handleMouseMove(e);
// });
// $("#logo").mouseup(function(e) {
//     handleMouseUp(e);
// });
// $("#logo").mouseout(function(e) {
//     handleMouseOut(e);
// });
//
// function output() {
//     bgctx.drawImage(canvas, 0, 0);
//     window.open(bg.toDataURL());
// }
