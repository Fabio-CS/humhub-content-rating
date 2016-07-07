<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\contentrating\Assets;
use app\modules\contentrating\models\Rating;

Assets::register($this);
?>
<?php if (Rating::hasContentTags($user)) :?>
   

    <div id="content-user-tags-panel" class="panel panel-default" style="position: relative;">

        <?php echo \humhub\widgets\PanelMenu::widget(['id' => 'user-tags-panel']); ?>

        <div class="panel-heading"><strong>Qualidade de conteúdo do usuário</strong></div>
        <div class="panel-body">
            <!-- start: tags for user skills -->
            <div class="tags">
                <?php foreach (Rating::getUserTagAverage($user->contents) as $tag): 
                    $tagId = str_replace(" ","_", $tag->name);
                    ?>
                    <p class="btn btn-default btn-xs tag"><?=$tag->name?></p>
                    <input id="content_rating_<?=$tagId?>" name="content_rating_<?=$tagId?>" type="number" value="<?=$tag->rating?>">
                    <script>
                    jQuery(document).ready(function () {
                        jQuery("#content_rating_<?=$tagId?>").rating({min:0, max:5, step:1, size:'xs', language: 'pt-BR', showClear: false, displayOnly: true, showCaption: false });
                    });
                    </script>
                <?php endforeach; ?>
            </div>
            <!-- end: tags for user skills -->

        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    function toggleUp() {
        $('.pups').slideUp("fast", function () {
            // Animation complete.
            $('#collapse').hide();
            $('#expand').show();
        });
    }

    function toggleDown() {
        $('.pups').slideDown("fast", function () {
            // Animation complete.
            $('#expand').hide();
            $('#collapse').show();
        });
    }
</script>