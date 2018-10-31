<?php
    require_once (ROOT.'/views/header.php');
?>

<div class="head-block"></div>
<div>
    <div class="photo profile-photo"></div>
    <div class="xlogin"><b><?=USER['login']?></b></div>
    <div class="inform"><b><?=USER['email']?></b></div>
    <div class="inform">
        Notifications
        <?php if(USER['notif_enabled']) : echo "ON"; else : echo "OFF"; endif;?>
    </div>
</div>


<div class="main">
    <div class="flex-main">
        <?php
        $images = Images::getAllByOwner(USER['id'], 0, 100);
        foreach ($images as $value) {
            print '<div class="photo" onmouseover="showRomove(this)" onmouseleave="hideRomove(this)" onclick="return removePhoto('.$value["id"].')">
                        <img src="images/'.$value["name"].'" alt="image">
                        
                        <div class="clear">
                            <i class="material-icons" style="color: red">clear</i>
                        </div>
                   </div>';
        }
        ?>

    </div>
</div>

<?php
    require_once (ROOT.'/views/footer.php');
?>
