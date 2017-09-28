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
    context.translate(canvas.width, 0);
    context.scale(-1, 1);
}, onCameraFail);


//таймер, изображение постоянно копируется в canvas
cameraInterval = setInterval(function() { snapshot();}, 33);
function snapshot() {
    if (localMediaStream) {
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
}

var img = null;

function imgDraw(src) {
    if (!document.getElementById('img')) {
        var daddy = document.getElementById('daddy');
        img = document.createElement('img');
        img.id = 'img';
        daddy.appendChild(img);
    } else {
        img = document.getElementById('img');
    }
    img.src = src;
    img.onmousedown = function(e) {

        var coords = getCoords(img);
        var shiftX = e.pageX - coords.left;
        var shiftY = e.pageY - coords.top;

        img.style.position = 'absolute';
        document.body.appendChild(img);
        moveAt(e);

        img.style.zIndex = 1000; // над другими элементами

        function moveAt(e) {
            img.style.left = e.pageX - shiftX + 'px';
            img.style.top = e.pageY - shiftY + 'px';
        }

        img.onmousemove = function(e) {
            moveAt(e);
        };

        img.onmouseup = function() {
            document.onmousemove = null;
            img.onmouseup = null;
        };

    };
    img.ondragstart = function() {
        return false;
    };

    img.onerror = function () {
        alert('Broken image');
    };
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



function clearButton() {
    var daddy = document.getElementById('daddy');
    var butt = document.getElementById('img');
    if (butt) {
        daddy.removeChild(butt);
    }
}

function snap() {
    var takeImg1 = document.getElementById('canvas1');
    var ctx = takeImg1.getContext("2d");

    console.log(canvas);
    ctx.drawImage(canvas, 0, 0, canvas.width, canvas.height);
    ctx.scale(takeImg1.width, takeImg1.height);
    var imgObj = new Image();
    if (img) {
        imgObj.src = img.src;
        imgObj.onload = function () {
            ctx.drawImage(imgObj, 0, 0, img.width, img.height);
        };
    }
}


// var image = takeImg1.toDataURL("image/png");
// document.write('<img src="' + img + '" width="328" height="526"/>');


// var c=document.getElementById("myCanvas");
// var ctx=c.getContext("2d");
// var imageObj1 = new Image();
// var imageObj2 = new Image();
// imageObj1.src = "1.png"
// imageObj1.onload = function() {
//     ctx.drawImage(imageObj1, 0, 0, 328, 526);
//     imageObj2.src = "2.png";
//     imageObj2.onload = function() {
//         ctx.drawImage(imageObj2, 15, 85, 300, 300);
//         var img = c.toDataURL("image/png");
//         document.write('<img src="' + img + '" width="328" height="526"/>');
//     }
// };
