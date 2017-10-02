
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
    // context.translate(canvas.width, 0);
    // context.scale(-1, 1);
}, onCameraFail);


var mask = null;
var maskX = null;
var maskY = null;


//таймер, изображение постоянно копируется в canvas
cameraInterval = setInterval(function() { snapshot();}, 33);
function snapshot() {
    if (localMediaStream) {
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
    if (mask) {
        maskX = getCoords(mask).left;
        // console.log(maskX);
        maskY = getCoords(mask).top;
        context.drawImage(mask, maskX, maskY, mask.width, mask.height);
    }
}


function changeMask(src) {
    var tmpMask;
    tmpMask = new Image();
    tmpMask.src = src;
    tmpMask.onload = function () {
        mask = tmpMask;
    };

    // var move = maskMove(mask);
}



mask.onmousedown = function(e) {
    var coords = getCoords(mask);
    var shiftX = e.pageX - coords.left;
    var shiftY = e.pageY - coords.top;

    // img.style.position = 'absolute';
    // document.body.appendChild(img);
    moveAt(e);

    mask.style.zIndex = 100;

    function moveAt(e) {
        mask.style.left = e.pageX - shiftX + 'px';
        mask.style.top = e.pageY - shiftY + 'px';
    }

    mask.onmousemove = function(e) {
        moveAt(e);
    };

    mask.onmouseup = function() {
        document.onmousemove = null;
        mask.onmouseup = null;
    };

};
mask.ondragstart = function() {
    return false;
};



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


function clearButton() {
    mask = null;
}


function snap() {
    var takeImg1 = document.getElementById('canvas1');
    var ctx = takeImg1.getContext("2d");
    takeImg1.width = canvas.width;
    takeImg1.height = canvas.height;
    ctx.drawImage(canvas, 0, 0, takeImg1.width, takeImg1.height);

    var imgObj = new Image();
    if (mask) {

        imgObj.src = mask.src;
        imgObj.onload = function () {
            ctx.drawImage(imgObj, 0, 0, mask.width, mask.height);
        };
    }
}


