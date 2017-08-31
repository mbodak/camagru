<?php
    include ("head.php");
    include ("header.php");
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
            <form method="post" name="login-form" id="login-form">
                <div class="row">
                    <div class="new">
                        <div class="medium-1 medium-offset-2 columns">
                            <label for="first_name">First name</label>
                            <input id="first_name" name="first_name" type="text" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="username">E-mail</label>
                            <input id="username" name="username" type="email" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <a href="/Camagru/login.php" class="button submit back" type="button" value="Back">
                                <span>Back</span>
                            </a>
                        </div>
                    </div>

                    <div class="registered">
                        <div class="medium-1 medium-offset-2 columns">
                            <label for="username">Last name</label>
                            <input id="last_name" name="last_name" type="text" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" value="" class="cleaninput border-bottom" required="">
                        </div>

                        <div class="medium-1 medium-offset-2 columns">
                            <button class="button submit" type="submit" value="Save">
                                <span>Save</span>
                            </button>
                        </div>
                    </div>

                </div>
            </form>


        </div>



    </div>
</main>
<?php
    include ("footer.php");
?>
