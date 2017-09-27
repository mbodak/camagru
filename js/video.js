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
cameraInterval = setInterval(function() { snapshot();}, 1);
function snapshot() {
    if (localMediaStream) {
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
}

function imgDraw(src) {
    if (!document.getElementById('img')) {
        var daddy = document.getElementById('tmp');
        var img = document.createElement('img');
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

        document.onmousemove = function(e) {
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
    // (1)
    var box = elem.getBoundingClientRect();

    var body = document.body;
    var docEl = document.documentElement;

    // (2)
    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

    // (3)
    var clientTop = docEl.clientTop || body.clientTop || 0;
    var clientLeft = docEl.clientLeft || body.clientLeft || 0;

    // (4)
    var top  = box.top +  scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;

    // (5)
    return { top: Math.round(top), left: Math.round(left) };
}



function clearButton() {
    var daddy = document.getElementById('tmp');
    var butt = document.getElementById('img');
    if (butt) {
        daddy.removeChild(butt);
    }
}





// function mouseMove(img) {
//     img.onmousedown = function(){return false;};
//     img.style.cursor = 'move';
//     // console.log(img);
//     img.onmousemove = function(e){
//         console.log('here');
//         x = e.pageX;
//         y = e.pageY;
//         left = img.offsetLeft;
//         top = img.offsetTop;
//         left = x - left;
//         top = y - top;
//         // img.onmousemove = function(e){
//         //     console.log(e.pageX, e.pageY);
//         //     x = e.pageX;
//         //     y = e.pageY;
//             img.style.top = y - top + 'px';
//             img.style.left = x - left + 'px;';
//         // }
//     };
//     img.onmouseup = function(){
//         img.style.cursor = 'auto';
//         img.onmousedown = function(){};
//         img.onmousemove = function(){};
//     }
// }

// function mouseMove(img) {
//
//     var drp = false; // true - если перетаскиваем
//     var pozx = 0;
//     var pozy = 0; // координаты начала отображения изображения
//     var smx = 0;
//     var smy = 0;   // координаты мыши - нажали на кнопку
//     var emx = 0;
//     var emy = 0;   // координаты мыши - опустили на кнопку
//
//
//     iw = img.width;
//     ih = img.height;
//     sw = $("#canvas").width();
//     sh = $("#canvas").height();
//
//
// // Событие на нажатие кнопки мыши
//     document.getElementById('canvas').onmousedown = function (e) {
//         smx = e.clientX;
//         smy = e.clientY;
//         drp = true;
//     };
// // Событие на опускание кнопки мыши
//     document.getElementById('canvas').onmouseup = function (e) {
//         drp = false;
//     };
//
//     iw = img.width;
//     ih = img.height;
//     sw = $("#canvas").width();
//     sh = $("#canvas").height();
//     document.getElementById('canvas').onmousemove = function (e) {
//         if (drp === true) {
//             emx = e.clientX;
//             emy = e.clientY;
//             pozx = pozx + (smx - emx);
//             pozy = pozy + (smy - emy);
// // отлавливаем выход за пределы экрана
//             if (pozx < 0) {
//                 pozx = 0;
//             }
//             if (pozy < 0) {
//                 pozy = 0;
//             }
//             if (pozx > (img.width - iw)) {
//                 pozx = img.width - iw;
//             }
//             if (pozy > (img.height - ih)) {
//                 pozy = img.height - ih;
//             }
//             context.drawImage(img, pozx, pozy, iw, ih, 0, 0, sw, sh);
//         }
//         smx = e.clientX;
//         smy = e.clientY;
//     };
// }