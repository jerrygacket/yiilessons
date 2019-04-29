<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 11:55
 */

namespace app\components;


use app\base\BaseRepository;
use app\models\Activity;

class ActivityRepository extends BaseRepository implements \RepositoryInterface
{

    public function getDb(){
        return \Yii::$app->db;
    }

    public function createElement($element = []): bool
    {
        $cnt=$this->getDb()->createCommand()->insert('activity',$element)->execute();

        return $cnt;
    }

    public function updateElement($element): bool
    {
        // TODO: Implement updateElement() method.
    }

    public function getElementById($id)
    {
        $data=$this->getDb()->createCommand('select * from activity where id=:id',[':id'=>$id])->queryOne();
        $model=new Activity();
        $model->setAttributes($data);

        return $model;
    }

    public function getOne($where = ['id' => 1])
    {
        // TODO: Implement getOne() method.
    }

    public function getMany($where = ['id' => 1])
    {
        // TODO: Implement getMany() method.
    }

    public function deleteElement($id)
    {
        // TODO: Implement deleteElement() method.
    }
}