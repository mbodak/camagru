<?php
    include ("head.php");
    include ("header.php");
?>
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
                    <video id="video" autoplay poster="/Camagru/icons/logo.png"></video>
                </div>
                <script>
                    // Grab elements, create settings, etc.
                    var video = document.getElementById('video');

                    // Get access to the camera!
                    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        // Not adding `{ audio: true }` since we only want video now
                        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                            video.src = window.URL.createObjectURL(stream);
                            video.play();
                        });
                    }
                    // Elements for taking the snapshot

                    var canvas = document.getElementById('canvas');
                    var context = canvas.getContext('2d');
                    video = document.getElementById('video');

                    // Trigger photo take
                    document.getElementById("snap").addEventListener("click", function() {
                        context.drawImage(video, 0, 0, 640, 480);
                    });
                </script>
                <div class="tools">
                    <div title="select">

                    </div>
                    <div>

                    </div>
                    <div>

                    </div>
                    <div>

                    </div>
                    <div>

                    </div>
                    <div>

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
</main>




<?php
    include ("footer.php");
?>
