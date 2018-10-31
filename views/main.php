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
                    <div class="photo" onmouseover="showLikesCover(this)" onmouseleave="hideLikesCover(this)">
                            <img src="images/'.$value["name"].'" alt="image">
                            
                            <div class="photo-hover">
                                <div class="set-like">
                                    <i class="material-icons like" onclick="setLike(this.parentElement.parentElement.parentElement)">thumb_up</i>
                                    <i class="material-icons dislike" onclick="removeLike(this.parentElement.parentElement.parentElement)">thumb_down</i>
                                </div>
                                <div class="count-likes">
                                    <i class="material-icons" style="color: red">favorite</i>
                                    <i><b>'.$value["likes_count"].'</b></i>
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
