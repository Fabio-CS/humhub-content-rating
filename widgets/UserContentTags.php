<?php

namespace app\modules\contentrating\widgets;

/**
 * UserContentTagsWidget lists all skills/tags of the user
 *
 * @package humhub.modules_core.user.widget
 * @author Fabio Miranda
 */
class UserContentTags extends \yii\base\Widget
{

    public $user;

    public function run()
    {
        return $this->render('userContentTags', array('user' => $this->user));
    }

}

?>
