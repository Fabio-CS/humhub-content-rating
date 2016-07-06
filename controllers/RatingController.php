<?php

namespace app\modules\contentrating\controllers;

use Yii;
use yii\web\Controller;
use app\modules\contentrating\models\Rating;

class RatingController extends Controller
{

    public function actionRating()
    {
        Yii::$app->response->format = 'json';
        $contentId = Yii::$app->request->post('content_id');
        $rate = Yii::$app->request->post('rate');
        $userId = Yii::$app->user->id;
        
        $rating = new Rating();
        $rating->user_id = $userId;
        $rating->content_id = $contentId;
        $rating->rate = $rate;
        
        if($rating->validate() && $rating->save()){
            $average = Rating::getAverage($contentId);
            return array('average' => $average, 'content_id' => $contentId);
        }else{
            return array('errors' => $rating->getErrors());
        }
    }

}
