<?php
    require_once (ROOT.'/views/header.php');
?>

<div class="head-block"></div>

<div class="main">
    <div class="flex-main">
        <?php
        $images = Images::getAll(0, 1000);
        foreach ($images as $value) {
            print '
                    <div class="photo" onmouseover="showLikesCover('.$value["id"].', this)" onmouseleave="hideLikesCover(this)">
                            <img src="images/'.$value["name"].'" alt="image">
                            
                            <div class="photo-hover">
                                <div class="set-like">
                                    '; if (LOGGED_IN) : print '
                                    <i class="material-icons like" style="color: red" onclick="setLike('.$value["id"].', this.parentElement.parentElement)">thumb_up</i>
                                    <i class="material-icons dislike" style="color: red" onclick="removeLike('.$value["id"].', this.parentElement.parentElement)">thumb_down</i>
                                    '; endif; print '
                                </div>
                                <div class="count-likes">
                                    <i class="material-icons" style="color: red">favorite</i>
                                    <i><b class="lco" style="color: red">'.$value["likes_count"].'</b></i>
                                </div>
                            </div>
                    </div>';
        }
        ?>

    </div>
</div>

<?php
    require_once (ROOT.'/views/footer.php');
?>
