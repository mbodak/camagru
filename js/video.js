
var video = document.querySelector("#video");
var canvas = document.querySelector('#canvas');
var context = canvas.getContext('2d');
var localMediaStream = null;

var mask = null;
var maskX = 0;
var maskY = 0;
var dragging = false;


onCameraFail = function (event) {
    console.log('Camera did not work.', event);
};

navigator.getUserMedia = navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia;

window.URL = window.URL || window.webkitURL;

navigator.getUserMedia({video: true}, function(stream) {
    video.src = window.URL.createObjectURL(stream);
    video.play();
    localMediaStream = stream;
}, onCameraFail);


cameraInterval = setInterval(function() { snapshot();}, 33);

function snapshot() {
    if (localMediaStream) {
        canvas.width = video.offsetWidth;
        canvas.height = video.offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
    if (mask) {
        maskX = (canvas.width - mask.width) / 2;
        maskY = (canvas.height - mask.height) / 2;

        var index = mask.height / mask.width;
        if (index > 1) {
            mask.height = canvas.height / 2;
            mask.width = mask.height / index;
        } else {
            mask.width = canvas.width / 3;
            mask.height = mask.width * index;
        }
        context.drawImage(mask, maskX, maskY, mask.width, mask.height);
        context.save();
    }
}

function changeMask(src) {
    var tmpMask;
    tmpMask = new Image();
    tmpMask.src = src;
    tmpMask.onload = function () {
        mask = tmpMask;
    };
}

function clearButton() {
    mask = null;
}

function snapPhoto() {
    var takeImg1 = document.querySelector('#canvas1');
    var ctx = takeImg1.getContext("2d");
    takeImg1.width = canvas.width;
    takeImg1.height = canvas.height;
    ctx.drawImage(canvas, 0, 0, takeImg1.width, takeImg1.height);

    var imgObj = new Image();
    if (mask) {
        imgObj.src = mask.src;
        imgObj.onload = function () {
            ctx.drawImage(imgObj, maskX, maskY, mask.width, mask.height);
        };
    }
}

function downloadPhoto() {
    var fileToLoad = document.getElementById("downloadPhoto").files[0];
    var reader = new FileReader();
    reader.onloadend = function() {

    };
    if (fileToLoad) {
        reader.readAsDataURL(fileToLoad);
    }
}

function uploadMask() {
    var fileToLoad = document.getElementById("uploadMask").files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        changeMask(reader.result);
    };
    if (fileToLoad) {
        reader.readAsDataURL(fileToLoad);
    }
}









function getCoords(elem) {
    var box = elem.getBoundingClientRect();

    var body = document.body;
    var docEl = document.documentElement;

    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

    var clientTop = docEl.clientTop || body.clientTop || 0;
    var clientLeft = docEl.clientLeft || body.clientLeft || 0;

    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    return { top: Math.round(top), left: Math.round(left) };
}