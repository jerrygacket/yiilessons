<?php


namespace app\components;


use app\base\BaseComponent;
use app\models\Users;
use yii\data\ActiveDataProvider;

class UserComponent extends BaseComponent
{
    /**
     * @return Users
     */
    public function getModel() {

        return new $this->nameClass(Users::find()->andWhere(['id'=>\Yii::$app->user->id])->one());
    }

    public function getSingleDataProvider($params) {
        $model = new Users();
        $model->load($params);
        $query = $model::find()->andWhere(['id'=>\Yii::$app->user->id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $provider;

    }

    /**
     * @param $model Users
     * @return bool
     */
    public function saveUser(&$model):bool{
        if ($model->id == '' || $model->id != \Yii::$app->user->id) {
            return false;
        }

        $currentUser = Users::findOne(\Yii::$app->user->id);
        $currentUser->email = $model->email;

        if (!$currentUser->save()) {
            $model->getErrors();
            return false;
        }

        return true;
    }
}