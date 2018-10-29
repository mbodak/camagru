<?php
    require_once (ROOT.'/views/header.php');
?>
<main class="backoffice">
    <div class="container">
        <div class="forheader"></div>

        <div class="transform-container">
            <div class="big-header">
                <h1>Lost password</h1>
            </div>
        </div>

        <div class="transform-container">
            <form method="post" name="forgot-form" id="forgot-form" onsubmit="return forgotPassword()">
                <div class="row modif">
                    <div class="registered">

                        <div class="medium-1 medium-offset-0 columns">
                            <h2>Forgot your password</h2>
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="username">E-mail</label>
                            <input id="username" name="username" type="email" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <button class="button submit" type="submit" value="Send">
                                <span>
                                    <strong>Send</strong>
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
