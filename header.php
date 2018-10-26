<html>
    <header>
        <div id="invisibleBox" style="display:none" onclick="w3_close()"></div>
        <div class="flex-header">

            <div class="box-actions">
                <button onclick="w3_open()">
                    <i class="material-icons">menu</i>
                </button>
            </div>

            <div class="box-logo">
                <a href="index.php">
                    <img class="logo" src="icons/logo.png" alt="camagru">
                </a>
            </div>

            <div class="box-nav">
                <div class="dropdown">
                    <button>
                        <i class="material-icons">face</i>
                    </button>

                    <div class="dropdown-content">
                        <a href="profile.php">Profile</a>
                        <a href="modif.php">Change password</a>
                        <a href="#">Notification ON</a>
                        <a href="#">LOG OUT</a>
                    </div>
                </div>
            </div>
        </div>
        <aside class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
            <h3>Menu</h3>
            <nav role="navigation">
                <ul>
                    <li>
                        <a href="index.php" class="w3-bar-item w3-button">Home</a>
                    </li>
                    <li>
                        <a href="profile.php" class="w3-bar-item w3-button">Profile</a>
                    </li>
                    <li>
                        <a href="take_photo.php" class="w3-bar-item w3-button">Take photo</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="login.php/" class="w3-bar-item w3-button">Log out</a>
                    </li>
                </ul>
            </nav>
        </aside>
<!--        <div class="search-overlay" style="display: none;" id="mySearch">-->
<!--            <svg class="close-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" onclick="close_search()">-->
<!--                <polygon points="64,5.9 58.1,0 32,26.1 5.9,0 0,5.9 26.1,32 0,58.1 5.9,64 32,37.9 58.1,64 64,58.1 37.9,32"></polygon>-->
<!--            </svg>-->
<!--            <form role="search" method="get" class="search-form" action="/Camagru/">-->
<!--                <div>-->
<!--                    <input type="text" value="" name="s" id="s" placeholder="Type and press enter">-->
<!--                </div>-->
<!--            </form>-->
<!--            <form role="search" method="get" class="search-form" action="/Camagru/">-->
<!--                <div>-->
<!--                    <input type="text" value="" name="s" id="s" placeholder="Type and press enter">-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
    </header>
</html>