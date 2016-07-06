<?php

use humhub\modules\content\widgets\WallEntryAddons;

return [
    'id' => 'contentrating',
    'class' => 'app\modules\contentrating\Module',
    'namespace' => 'app\modules\contentrating',
    'events' => array(
        array('class' => WallEntryAddons::className(), 'event' => WallEntryAddons::EVENT_INIT, 'callback' => array('app\modules\contentrating\Events', 'onWallEntryAddonsInit')),
    ),
];
?>
