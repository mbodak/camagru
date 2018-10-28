<?php
    require_once (ROOT.'/views/header.php');
?>
<main class="backoffice">
    <div class="container">
        <div class="forheader"></div>

        <div class="transform-container">
            <div class="big-header">
                <h1>Change Password</h1>
            </div>
        </div>

        <div class="transform-container">
            <form method="post" name="change-form" id="change-form">
                <div class="row modif">
                    <div class="registered">

                        <div class="medium-1 medium-offset-0 columns">
                            <h2>Change your password</h2>
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">Old Password</label>
                            <input id="password3" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">New Password</label>
                            <input id="password4" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <button class="button submit" type="submit" value="Send">
                                <span>
                                    <strong>Change</strong>
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
