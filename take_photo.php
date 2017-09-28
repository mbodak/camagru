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
                <div class="video" id="daddy">
                    <canvas id="canvas"></canvas>
                </div>

                <div class="tools">
                    <div class="mask" title="select" onclick="imgDraw('/Camagru/stickers/face.png')">
                        <img src="/Camagru/stickers/face.png">
                    </div>

                    <div class="mask" onclick="imgDraw('/Camagru/stickers/hair.png')">
                        <img src="/Camagru/stickers/hair.png">
                    </div>

                    <div class="mask" onclick="imgDraw('/Camagru/stickers/deer.png')">
                        <img src="/Camagru/stickers/deer.png">
                    </div>

                    <div class="mask" onclick="imgDraw('/Camagru/stickers/hat1.png')">
                        <img src="/Camagru/stickers/hat1.png">
                    </div>

                    <div class="mask" onclick="imgDraw('/Camagru/stickers/mas.png')">
                        <img src="/Camagru/stickers/mas.png">
                    </div>

                    <div>
                        <p>UPLOAD</p>
                    </div>

                </div>

            </div>

            <div class="actions">
                <div>
                    <button id="snap" onclick="snap()">Snap</button>
                </div>
                <div>
                    <button id="download">Download</button>
                </div>
                <div>
                    <button id="clearButton" onclick="clearButton()">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/Camagru/js/video.js"></script>
<?php
    include ("footer.php");
?>
