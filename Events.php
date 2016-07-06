<?php

namespace app\modules\contentrating;

use Yii;
use yii\helpers\Url;

class Events extends \yii\base\Object
{

    public static function onTopMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => 'ContentRating',
            'url' => Url::toRoute('/contentrating/rating/index'),
            'icon' => '<i class="fa fa-sun-o"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'contentrating'),
        ));
    }
    
    public static function onWallEntryAddonsInit($event)
    {
    	$event->sender->addWidget(widgets\ContentRating::className(), array('object' => $event->sender->object), array('sortOrder' => 2));
    }

}
