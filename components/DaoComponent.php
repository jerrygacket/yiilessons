<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 29.04.19
 * Time: 9:58
 */

namespace app\components;

use yii\base\Component;
use yii\db\Connection;
use yii\db\Query;


class DaoComponent extends Component
{

    /** @var Connection */
    public $connection;
    /**
     * @return Connection
     */
    public function getDb(){
        return $this->connection;
    }
    public function getActivityNotification(){
        $query=new Query();
        $query->select(['title','dateSTart','user_id'])
            ->from('activity')
            ->andWhere(['useNotification'=>1])
            ->andWhere('user_id=:user',[':user' => 2])
            ->limit(2)
            ->orderBy(['title'=>SORT_DESC]);
        return $query->all();
    }

    public function getFirstActivity(){
        $query=new Query();
        return $query->from('activity')
            ->limit(3)
            ->one($this->getDb());
    }

    public function getCountActivity(){
        $query=new Query();
        return $query->from('activity')
            ->select('count(id) as cnt')
            ->scalar();
    }

    public function getActivityUser($user_id){
        $sql='select * from activity where user_id=:user';
        return $this->getDb()->
        createCommand($sql,[':user'=>$user_id])
            ->queryAll();
    }

    public function testInsert(){
        $trans=$this->getDb()->beginTransaction();
        try {
            $this->getDb()->createCommand()
                ->insert('activity', ['title' => 'testTile',
                    'dateStart' => date('Y-m-d'),
                    'user_id' => 1])
                ->execute();
            $id = $this->getDb()->getLastInsertID();
//            throw new Exception('test');
            $this->getDb()->createCommand()->update('activity',
                ['user_id' => 2], ['id' => $id])->execute();
            $trans->commit();
        }catch (\Exception $e){
            $trans->rollBack();
        }
    }

    public function getAllUsers(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->queryAll();
    }

}