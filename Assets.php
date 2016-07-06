<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace app\modules\contentrating;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . '/assets';
        parent::init();
    }

    public $css = [
        'css/star-rating.css',
        'css/content-rating.css',
    ];
    
    public $js = [
        'js/star-rating.js',
        'js/locales/pt-BR.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
    
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
    
    public $publishOptions = [
        'forceCopy' => true,
         //you can also make it work only in debug mode: 'forceCopy' => YII_DEBUG
    ];

}
