<?php
    require_once (ROOT.'/views/header.php');
?>
<main class="backoffice">
    <div class="container">
        <div class="forheader"></div>

        <div class="transform-container">
            <div class="big-header">
                <h1>Lost Password</h1>
            </div>
        </div>

        <div class="transform-container">
            <form method="post" name="recover-form" id="recover-form" onsubmit="return recoverPassword()">
                <div class="row modif">
                    <div class="registered">

                        <div class="medium-1 medium-offset-0 columns">
                            <h2>Recover your password</h2>
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">New Password</label>
                            <input id="password1" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">Repeat Password</label>
                            <input id="password2" name="repeat_password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <button class="button submit" type="submit" value="Send">
                                <span>
                                    <strong>Accept</strong>
                                </span>
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
    require_once (ROOT.'/views/footer.php');
?>
