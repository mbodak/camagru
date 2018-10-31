<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="mbodak" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>Camagru</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link href="style/header.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/main.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/footer.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/login.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/take_photo.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/sidebar.css?v=<?=time();?>" rel='stylesheet' type='text/css'>
        <link href="style/searchform.css?v=<?=time();?>" rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript" src="js/formsValidation.js"></script>
    </head>

    <header>
        <div id="invisibleBox" style="display:none" onclick="menu_close()"></div>
        <div class="flex-header">

            <div class="box-actions">
                <button onclick="menu_open()">
                    <i class="material-icons">menu</i>
                </button>
            </div>

            <div class="box-logo">
                <a href='home'>
                    <img class="logo" src="icons/logo.png" alt="camagru">
                </a>
            </div>
            <div class="box-nav">
                <div class="nickname">
                    <?php if(LOGGED_IN) : ?>
                    <b><?=USER['login']?></b>
                    <?php endif; ?>
                </div>
                <div class="dropdown">
                    <button>
                        <i class="material-icons">face</i>
                    </button>

                    <div class="dropdown-content">
                        <?php if(LOGGED_IN) : ?>
                            <a href='profile'>Profile</a>
                            <a href='change'>Change password</a>
                            <a href='notifications'>
                                <?php if(USER['notif_enabled']) : echo "Disable"; else : echo "Enable"; endif;?>
                                notifications
                            </a>
                            <a href='logout'>LOG OUT</a>
                        <?php else : ?>
                            <a href='sign-up'>sign up</a>
                            <a href='login'>log in</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <aside class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
            <h3>Menu</h3>
            <nav role="navigation">
                <ul>
                    <li>
                        <a href='home' class="w3-bar-item w3-button">Home</a>
                    </li>
                    <?php if(LOGGED_IN) : ?>
                        <li>
                            <a href='profile' class="w3-bar-item w3-button">Profile</a>
                        </li>
                        <li>
                            <a href='take-photo' class="w3-bar-item w3-button">Take photo</a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href='sign-up' class="w3-bar-item w3-button">Sign up</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul>
                    <?php if(LOGGED_IN) : ?>
                        <li>
                            <a href='logout' class="w3-bar-item w3-button">Log out</a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href='login' class="w3-bar-item w3-button">Log in</a>
                        </li>
                    <?php endif; ?>
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
<!--        --><?php //if(LOGGED_IN) : ?>
<!--        --><?php //else : ?>
<!--        --><?php //endif; ?>
    </header>
</html>