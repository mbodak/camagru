<?php
//    include ("database.php");
//
//    $result = mysqli_query($conn, "SELECT login, password FROM users");
//    foreach ($result as $val)
//    {
//        if ($val['login'] == $_POST['login'] && $val['password'] == hash("sha512", $_POST['password']))
//            setcookie("login", $_POST['login'], time()+3600);
//    }
//    header("Location: index.php");
//?>

<?php
    include ("head.php");
    include ("header.php");
?>

<link href="/Camagru/style/login.css?v=<?=time();?>" rel='stylesheet' type='text/css'>


<main class="backoffice" style="opacity: 1">
<div class="container transform-container">

    <div class="transform-container">
        <div class="big_header">
            <h1>CAMAGRU member login</h1>
        </div>
    </div>

    <div class="transform-container">
        <form method="post" name="login-form" id="login-form">
            <div class="row">
                <div class="small-12 medium-5 medium-offset-1 columns">
                    <h2>New Member</h2>
                </div>

                <div class="hide-for-small medium-5 medium-offset-0 columns">
                    <h2>Registered Member</h2>
                </div>

                <div class="small-12 medium-4 3 medium-offset-1 columns">
                    <a href="#" class="button button--full button--blue-on-green">
                        <span>
                            <strong>Create account</strong>
                        </span>
                        <span class="hover">
                            <strong>Create account</strong>
                        </span>
                    </a>
                </div>

                <div class="small-12 medium-5 medium-offset-1 columns">
                    <label for="username">E-mail</label>
                    <input id="username" name="username" type="email" value="" class="cleaninput border-bottom" required="">
                </div>

                <div class="small-12 medium-5 medium-offset-6 columns">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                </div>

                <div class="small-12 medium-5 medium-offset-6 columns">
                    <p>
                        <a href="#">Forgot your password?</a>
                    </p>
                </div>

                <div class="small-12 medium-5 medium-offset-6 columns">
                    <input type="hidden" id="_wpnonce" name="_wpnonce" value="9abe9d4b7c">
                    <input type="hidden" name="_wp_http_referer" value="/my-account/">
                    <input type="hidden" name="login" value="Login">
                    <button class="button submit" type="submit" value="Login">
                        <span>
                            <strong>Login</strong>
                        </span>
                        <span class="hover">
                            <strong>Login</strong>
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</main>