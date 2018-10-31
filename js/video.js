
var video = document.querySelector("#video");
var canvas = document.querySelector('#canvas');
var context = canvas.getContext('2d');
var localMediaStream = null;

var mask = null;
var maskX = 0;
var maskY = 0;
var dragging = false;
const snapButton = document.querySelector('#snap');


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
    snapButton.classList.remove("snap-disable");
    let tmpMask = new Image();
    tmpMask.src = src;
    tmpMask.onload = function () {
        mask = tmpMask;
    };
}

function clearButton() {
    snapButton.classList.add("snap-disable");
    mask = null;
}

function snapPhoto() {
    {
        if (!mask) {
            return;
        }
        const cvs1 = document.querySelector('#canvas1');
        const ctx1 = cvs1.getContext("2d");
        const cvs2 = document.querySelector('#canvas2');
        const ctx2 = cvs2.getContext("2d");
        const cvs3 = document.querySelector('#canvas3');
        const ctx3 = cvs3.getContext("2d");
        const cvs4 = document.querySelector('#canvas4');
        const ctx4 = cvs4.getContext("2d");
        const cvs5 = document.querySelector('#canvas5');
        const ctx5 = cvs5.getContext("2d");
        const cvs6 = document.querySelector('#canvas6');
        const ctx6 = cvs6.getContext("2d");
        const cvs7 = document.querySelector('#canvas7');
        const ctx7 = cvs7.getContext("2d");

        cvs7.width = cvs6.width;
        cvs7.height = cvs6.height;
        ctx7.drawImage(cvs6, 0, 0, cvs7.width, cvs7.height);

        cvs6.width = cvs5.width;
        cvs6.height = cvs5.height;
        ctx6.drawImage(cvs5, 0, 0, cvs6.width, cvs6.height);

        cvs5.width = cvs4.width;
        cvs5.height = cvs4.height;
        ctx5.drawImage(cvs4, 0, 0, cvs5.width, cvs5.height);

        cvs4.width = cvs3.width;
        cvs4.height = cvs3.height;
        ctx4.drawImage(cvs3, 0, 0, cvs4.width, cvs4.height);

        cvs3.width = cvs2.width;
        cvs3.height = cvs2.height;
        ctx3.drawImage(cvs2, 0, 0, cvs3.width, cvs3.height);

        cvs2.width = cvs1.width;
        cvs2.height = cvs1.height;
        ctx2.drawImage(cvs1, 0, 0, cvs2.width, cvs2.height);

        cvs1.width = canvas.width;
        cvs1.height = canvas.height;
        ctx1.drawImage(canvas, 0, 0, cvs1.width, cvs1.height);

    }


    var imgObj = new Image();
    if (mask) {
        imgObj.src = mask.src;
        imgObj.onload = function () {
            ctx.drawImage(imgObj, maskX, maskY, mask.width, mask.height);
        };
    }
    let imageSrc = canvas.toDataURL("image/png");
    let img = new Image();
    img.onload = function () {
        document.getElementById('f-file').value = img.src;
        let fd = new FormData(document.forms["send-photo-form"]);
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'savephoto', true);
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(fd);
    };
    img.src = imageSrc;
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