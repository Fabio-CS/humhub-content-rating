<?php

namespace app\modules\contentrating\widgets;

use yii\helpers\Url;

class ContentRating extends \yii\base\Widget
{

    public $object;
    
    public function init(){
        
    }
    
    public function run()
    {
    	$permaLink = Url::to(['/content/perma', 'id' => $this->object->content->id], true);
        return $this->render('contentRating', array(
        			'object' 	=> $this->object,
        			'id' 		=> $this->object->getUniqueId(),
        			'permalink'	=> $permaLink,
        ));
    }

}

?>
