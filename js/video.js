
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
var maskX = 0;
var maskY = 0;
var isDragging = false;


//таймер, изображение постоянно копируется в canvas
cameraInterval = setInterval(function() { snapshot();}, 33);
function snapshot() {
    if (localMediaStream) {
        canvas.width = document.getElementById('video').offsetWidth;
        canvas.height = document.getElementById('video').offsetHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }
    if (mask) {
        maskX = (canvas.height - mask.height) / 2;
        maskY = (canvas.width - mask.width) / 2;
        // context.drawImage(mask, maskY, maskX, mask.width, mask.height);
        // context.save();
        moveResize();
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


//Clear mask from canvas
function clearButton() {
    mask = null;
}


//Snap photo
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
            ctx.drawImage(imgObj, maskY, maskX, mask.width, mask.height);
        };
    }
}



function moveResize() {

    var canvasOffset = getCoords(canvas);
    var offsetX = canvasOffset.left;
    var offsetY = canvasOffset.top;

    var isDown = false;

    var pi2 = 3.14 * 2;
    var resizerRadius = 8;
    var rr = resizerRadius * resizerRadius;
    var draggingResizer = {x: 0, y: 0};
    var imageX = maskY;
    var imageY = maskX;
    var imageWidth, imageHeight, imageRight, imageBottom;
    var draggingImage = false;
    var startX;
    var startY;

    var img = new Image();

    img.onload = function(){
        imageWidth = mask.width;
        imageHeight = mask.height;
        imageRight = imageX + imageWidth;
        imageBottom = imageY + imageHeight;
        draw(true, false);
    };

    img.src = mask.src;

    function draw(withAnchors, withBorders){

        // clear the canvas
        // context.clearRect(0, 0, canvas.width, canvas.height);
        //
        // // draw the image
        context.drawImage(img, 0, 0, img.width, img.height, imageX, imageY, imageWidth, imageHeight);

        // optionally draw the draggable anchors
        if (withAnchors){
            drawDragAnchor(imageX, imageY);
            drawDragAnchor(imageRight, imageY);
            drawDragAnchor(imageRight, imageBottom);
            drawDragAnchor(imageX, imageBottom);
        }

        // optionally draw the connecting anchor lines
        if (withBorders){
            context.beginPath();
            context.moveTo(imageX, imageY);
            context.lineTo(imageRight, imageY);
            context.lineTo(imageRight, imageBottom);
            context.lineTo(imageX, imageBottom);
            context.closePath();
            context.stroke();
        }

    }

    function drawDragAnchor(x, y){
        context.beginPath();
        context.arc(x, y, resizerRadius, 0, pi2, false);
        context.closePath();
        context.fill();
    }

    function anchorHitTest(x, y){

        var dx, dy;

        // top-left
        dx=x-imageX;
        dy=y-imageY;

        if(dx * dx + dy * dy <=rr){ return(0); }
        // top-right
        dx=x-imageRight;
        dy=y-imageY;
        if(dx*dx+dy*dy<=rr){ return(1); }
        // bottom-right
        dx=x-imageRight;
        dy=y-imageBottom;
        if(dx*dx+dy*dy<=rr){ return(2); }
        // bottom-left
        dx=x-imageX;
        dy=y-imageBottom;
        if(dx*dx+dy*dy<=rr){ return(3); }
        return(-1);

    }


    function hitImage(x,y){
        return(x>imageX && x<imageX+imageWidth && y>imageY && y<imageY+imageHeight);
    }


    function handleMouseDown(e){
        startX=parseInt(e.clientX-offsetX);
        startY=parseInt(e.clientY-offsetY);
        draggingResizer=anchorHitTest(startX,startY);
        draggingImage= draggingResizer<0 && hitImage(startX,startY);
    }

    function handleMouseUp(e){
        draggingResizer = -1;
        draggingImage = false;
        draw(true, false);
    }

    function handleMouseOut(e){
        handleMouseUp(e);
    }

    function handleMouseMove(e){

        if (draggingResizer > -1){

            mouseX=parseInt(e.clientX-offsetX);
            mouseY=parseInt(e.clientY-offsetY);

            // resize the image
            switch(draggingResizer){
                case 0: //top-left
                    imageX=mouseX;
                    imageWidth=imageRight-mouseX;
                    imageY=mouseY;
                    imageHeight=imageBottom-mouseY;
                    break;
                case 1: //top-right
                    imageY=mouseY;
                    imageWidth=mouseX-imageX;
                    imageHeight=imageBottom-mouseY;
                    break;
                case 2: //bottom-right
                    imageWidth=mouseX-imageX;
                    imageHeight=mouseY-imageY;
                    break;
                case 3: //bottom-left
                    imageX=mouseX;
                    imageWidth=imageRight-mouseX;
                    imageHeight=mouseY-imageY;
                    break;
            }

            // enforce minimum dimensions of 25x25
            if(imageWidth<25){imageWidth=25;}
            if(imageHeight<25){imageHeight=25;}

            // set the image right and bottom
            imageRight=imageX+imageWidth;
            imageBottom=imageY+imageHeight;

            // redraw the image with resizing anchors
            draw(true,true);

        }
        else if (draggingImage){

            imageClick = false;

            mouseX = parseInt(e.clientX-offsetX);
            mouseY = parseInt(e.clientY-offsetY);

            // move the image by the amount of the latest drag
            var dx=mouseX-startX;
            var dy=mouseY-startY;
            imageX += dx;
            imageY += dy;
            imageRight += dx;
            imageBottom += dy;
            // reset the startXY for next time
            startX = mouseX;
            startY = mouseY;

            // redraw the image with border
            draw(false, true);

        }


    }


    canvas.onmousedown = function(e){handleMouseDown(e);};
    canvas.onmousemove = function(e){handleMouseMove(e);};
    document.querySelector("#canvas").onmouseup = function(e){handleMouseUp(e);};
    document.querySelector("#canvas").onmouseout = function(e){handleMouseOut(e);};


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