<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Activity;
use app\models\Calendar;
use yii\data\ActiveDataProvider;

class CalendarComponent extends BaseComponent
{
    /**
     * @param array $params
     * @return mixed
     * @var $model Calendar
     */
    public function getModel($params=[]) {
        $model = new $this->nameClass;

        $model->number = $params['month'] ?? date('m');

        $model->title = Calendar::MONTH_NAMES[$model->number];

        $model->days = cal_days_in_month(CAL_GREGORIAN, $model->number, date('Y'));

        return $model;
    }

    public function getActivities($model)
    {
        $startDay = date('Y').'-'.$model->number.'-01';
        $endDay = date('Y').'-'.$model->number.'-'.$model->days;

        $activities = Activity::find()
            ->andWhere('dateEnd>=:date',[':date'=>$startDay])
            ->andWhere('dateStart<=:date1',[':date1'=>$endDay.' 23:59:59'])->all();

        return $activities;
    }

    /**
     * @param $params
     * @param $month Calendar
     * @return ActiveDataProvider
     */
    public function getDataProvider($params,$month) {
        $model = new Activity();
        $model->load($params);

        $startDay = date('Y').'-'.$month->number.'-01';
        $endDay = date('Y').'-'.$month->number.'-'.$month->days;

        $query = $model::find()
            ->andWhere('dateEnd>=:date',[':date'=>$startDay])
            ->andWhere('dateStart<=:date1',[':date1'=>$endDay.' 23:59:59']);

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