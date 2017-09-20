<?php
    include ("head.php");
    include ("header.php");
?>
<video id="video" autoplay poster="/Camagru/icons/logo.png"></video>
<div class="forheader"></div>
<main>
    <div class="page">
        <div class="wrapper">
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

                <div class="tools">
                    <div title="select"></div>

                    <div></div>

                    <div></div>

                    <div></div>

                    <div></div>

                    <div></div>

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
</main>



<script type="text/javascript" src="/Camagru/js/video.js"></script>
<?php
    include ("footer.php");
?>
