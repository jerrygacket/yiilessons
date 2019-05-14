<?php


namespace app\components;


use app\models\Activity;
use app\models\Day;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\FileHelper;

class DayComponent extends \app\base\BaseComponent
{

    /**
     * @return Day
     */
    public function getModel($params = []) {

        $day = new $this->nameClass;
//        $day->activities = $this->getActivities();
        return $day;
    }

    public function getActivities($dayId=null){
//        FileHelper::createDirectory(\Yii::getAlias('@webroot/activities'));
//        $files = FileHelper::findFiles(\Yii::getAlias('@webroot/activities/'));
//        $activities = [];
//        foreach ($files as $jsonFile) {
//            $activities[] = json_decode(file($jsonFile)[0]);
//        }

//        return $activities;
        $user_id = \Yii::$app->user->id;

        return Activity::find()->andWhere(['user_id'=>$user_id])->all();
    }

    public function getDataProvider($params) {
        $user_id = \Yii::$app->user->id;
        $model = new Activity();
        $model->load($params);

        $query = $model::find()->andWhere(['user_id'=>$user_id])->andFilterWhere(['like','email',$model->email]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id'=>SORT_DESC
                ]
            ]
        ]);

        return $provider;
    }
}