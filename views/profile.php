<?php
    require_once (ROOT.'/views/header.php');
?>

<div class="head-block"></div>
<div>
    <div class="photo profile-photo"></div>
    <div class="xlogin"><?=USER['login']?></div>
    <div class="xlogin"><?=USER['email']?></div>
    <div class="xlogin">
        Notifications
        <?php if(USER['notif_enabled']) : echo "ON"; else : echo "OFF"; endif;?>
    </div>
</div>


<div class="main">
    <div class="flex-main">
        <?php
        $images = Images::getAllByOwner(USER['id'], 0, 10);
        foreach ($images as $value)
            print_r($value);
        ?>
<!--        <div class="photo"><img src="images/31540996631869.jpg" alt="image"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->
<!--        <div class="photo"></div>-->

        <button class="load-more-butt">Load more...</button>

    </div>
</div>

<?php
    require_once (ROOT.'/views/footer.php');
?>
