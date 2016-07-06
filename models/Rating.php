<?php

/**
 */

namespace app\modules\contentrating\models;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\content\models\Content;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "rating".
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $user_id
 * @property integer $rate
 * 
 */
class Rating extends \yii\db\ActiveRecord implements \humhub\modules\search\interfaces\Searchable
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'user_id', 'rate'], 'required'],
            [['content_id','user_id', 'rate'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_content' => 'ID Content',
            'id_user' => 'ID User',
            'rate' => 'Rate'
        ];
    }

    /**
     * @inheritdoc
     *
     * @return ActiveQueryContent
     */
    public static function find()
    {
        return Yii::createObject(ActiveQuery::className(), [get_called_class()]);
    }

    public function getId()
    {
        return $this->id;
    }
    
    public static function getAverage($contentId){
        $ratings = Rating::find()->where(['content_id' => $contentId])->all();
        if($ratings && count($ratings) > 0 ){
            $sum = 0;
            foreach ($ratings as $rate) {
                $sum += $rate->rate;
            }
            $result = $sum / count($ratings);
            return number_format((float)$result, 2, '.', '');
        
        }else{
            return "0";
        }
    }
    
    public static function isRated($contentId, $userId){
        $rating = Rating::find()->where(['content_id' => $contentId, 'user_id' => $userId])->all();
        if($rating){
            return true;
        }else{
            return false;
        }
    }
    
    public static function myRate($contentId, $userId){
        $rating = Rating::find()->where(['content_id' => $contentId, 'user_id' => $userId])->one();
        if($rating){
            return $rating->rate;
        }else{
            return 0;
        }
    }
    
    public function getRate()
    {
        return $this->rate;
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function getContent()
    {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }
    
    public function getWallOut(){
        return \app\contentrating\widgets\ContentRating::widget(['rate' => $this]);
    }

    /**
     * Returns an array of informations used by search subsystem.
     * Function is defined in interface ISearchable
     *
     * @return Array
     */
    public function getSearchAttributes()
    {
        $attributes = array(
            'id' => $this->id,
            'user_id' => $this->user_id,
            'content_id' => $this->content_id,
            'rate' => $this->rate
        );

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    public function createUrl($route = null, $params = array(), $scheme = false)
    {
        if ($route === null) {
            $route = '/contentrating';
        }

        array_unshift($params, $route);
        if (!isset($params['id'])) {
            $params['id'] = $this->id;
        }

        return \yii\helpers\Url::toRoute($params, $scheme);
    }
    

}
