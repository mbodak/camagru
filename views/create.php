<?php
    require_once (ROOT.'/views/header.php');
?>
<main class="backoffice">
    <div class="container">
        <div class="forheader"></div>

        <div class="transform-container">
            <div class="big-header">
                <h1>Create new member account</h1>
            </div>
        </div>

        <div class="transform-container">
            <form method="post" name="create-form" id="create-form" onsubmit="return formValidationSignUp()">
                <div class="row">
                    <div class="new">
                        <div class="medium-1 medium-offset-2 columns">
                            <label for="login">Login</label>
                            <input id="login" name="login" type="text" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <a href='login' class="button submit back" type="button">
                                <span>Back</span>
                            </a>
                        </div>
                    </div>

                    <div class="registered">
                        <div class="medium-1 medium-offset-2 columns">
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="email" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">Repeat Password</label>
                            <input id="repeat_password" name="repeat_password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <input class="button submit" name="Submit"  type="submit" value="Register"/>
<!--                            <button class="button submit" type="submit" value="Save">-->
<!--                                <span>Register</span>-->
<!--                            </button>-->
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
