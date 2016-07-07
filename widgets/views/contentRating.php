<?php

use yii\helpers\Html;
use app\modules\contentrating\Assets;
use app\modules\contentrating\models\Rating;
use yii\helpers\Url;

Assets::register($this);
?>

<div class="content-rating-container">
    <input id="content_rating_<?=$object->content->id?>" name="content_rating_<?=$object->content->id?>" type="number" value="<?=  Rating::myRate($object->content->id, Yii::$app->user->id) ?>">
    <div class="average">
        <h4>Média<br><span id="content_rating_average_<?=$object->content->id?>"><?=Rating::getAverage($object->content->id)?></span></h4>
    </div>
</div>
<span class="clearboth"></span>
<p id="info" class="hidden"></p>
<script>
    jQuery(document).ready(function () {
        <?php if (! Rating::isRated($object->content->id, Yii::$app->user->id)) { ?>
        jQuery("#content_rating_<?= $object->content->id?>").rating({min:0, max:5, step:1, size:'xs', language: 'pt-BR', showClear: false });
    
        jQuery("#content_rating_<?= $object->content->id?>").on('rating.change', function(event, value, caption) {
            
                var rateURL = '<?= Url::to(['/contentrating/rating/rating'], true); ?>';
                $.ajax({
                    url: rateURL,
                    data: {
                       content_id: <?=$object->content->id?>,
                       rate: value
                    },
                    error: function(error) {
                       $('#info').html('Ocorreu um erro: ' + error);
                       $('#info').removeClass('hidden');
                       $('#info').addClass('error');
                    },
                    dataType: 'json',
                    success: function(response) {
                       handleResponse(response);
                    },
                    type: 'POST'
                });
                
                function handleResponse(response){
                    if(response.errors){
                       $('#info').html('Ocorreu um erro: ' + response.errors);
                       $('#info').removeClass('hidden');
                       $('#info').addClass('error');
                    }else{
                        $("#content_rating_"+response.content_id).rating('refresh', {readonly: true, showClear: false, showCaption: true});
                        $("#content_rating_average_"+response.content_id).html(response.average);
                    }
                }
        });
        <?php } else { ?>
        jQuery("#content_rating_<?= $object->content->id?>").rating({min:0, max:5, step:1, size:'xs', language: 'pt-BR', showClear: false, readonly: true });
        <?php } ?>
     });

</script>