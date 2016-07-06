<?php

Yii::app()->moduleManager->register(array(
    'id' => 'contentrating',
    'class' => 'application.modules.contentrating.Module',
    'import' => array(
        'application.modules.contentrating.*',
    ),
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('Events', 'onTopMenuInit')),
    ),
));
?>
