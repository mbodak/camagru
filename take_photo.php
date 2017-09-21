<?php
    include ("head.php");
    include ("header.php");
?>

<div class="forheader"></div>
<div class="main">
    <div class="page">
        <div class="wrapper">
            <video id="video" autoplay poster="/Camagru/icons/logo.png"></video>
            <div class="gallery">
                <div class="accordion">
                    <ul>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas1"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas2"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas3"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas4"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas5"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas6"></canvas>
                            </div>
                        </li>
                        <li>
                            <div>
                                <canvas class="canvas" id="canvas7"></canvas>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="camera">
                <div class="video">
                    <canvas id="canvas">
                </div>
<script>
    function imgOverlaying(src) {
        var img = new Image();
        img.onload = function () {
            context.drawImage(img, 0, 0);
        };
        img.onerror = function () {
            console.log('Broken image');
        };
        img.src = src;
    }
</script>
                <div class="tools">
                    <div title="select" onclick="imgOverlaying('/Camagru/stickers/face.png')">
                        <img src="/Camagru/stickers/face.png">
                    </div>

                    <div onclick="imgOverlaying('/Camagru/stickers/hair.png')">
                        <img src="/Camagru/stickers/hair.png">
                    </div>

                    <div onclick="imgOverlaying('/Camagru/stickers/deer.png')">
                        <img src="/Camagru/stickers/deer.png">
                    </div>

                    <div onclick="imgOverlaying('/Camagru/stickers/hat2.png')">
                        <img src="/Camagru/stickers/hat2.png">
                    </div>

                    <div onclick="imgOverlaying('/Camagru/stickers/mas.png')">
                        <img src="/Camagru/stickers/mas.png">
                    </div>

                    <div>
                        <p>UPLOAD</p>
                    </div>

                </div>

            </div>

            <div class="actions">
                <div>
                    <button id="snap">Snap</button>
                </div>
                <div>
                    <button id="download">Download</button>
                </div>
                <div>
                    <button id="">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/Camagru/js/video.js"></script>
<?php
    include ("footer.php");
?>
