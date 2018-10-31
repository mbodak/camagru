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
                    <div class="photo">
                        <img src="images/'.$value["name"].'" alt="image">
                        <div style="display: inline-block">'
                            .$value["likes_count"].
                        '</div>
                    </div>';
        }
        ?>

    </div>
</div>

<?php
    require_once (ROOT.'/views/footer.php');
?>
