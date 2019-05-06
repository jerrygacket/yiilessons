<?php
namespace app\components;

use app\rules\ViewOwnerActivityRule;
use yii\base\Component;

class RbacComponent extends Component
{
    /**
     * @return \yii\rbac\ManagerInterface
     */
    public function getAuthManager(){
        return \Yii::$app->authManager;
    }
    public function generateRbac(){
        $authManager=$this->getAuthManager();
        /** удаляем все правила */
        $authManager->removeAll();
        $admin = $authManager->createRole('admin');
        $user = $authManager->createRole('user');
        $authManager->add($admin);
        $authManager->add($user);
        $createActivity = $authManager->createPermission('createActivity');
        $createActivity->description='Создания активностей';
        $viewAllAcitvity = $authManager->createPermission('viewAllActivity');
        $viewAllAcitvity->description='Просмотр любых активностей';
        $viewOwnerRule = new ViewOwnerActivityRule();
        $authManager->add($viewOwnerRule);
        $viewOwnerAcitvity=$authManager->createPermission('viewOwnerActivity');
        $viewOwnerAcitvity->description='Просмотр только своих активностей';
        $viewOwnerAcitvity->ruleName=$viewOwnerRule->name;
        $authManager->add($createActivity);
        $authManager->add($viewAllAcitvity);
        $authManager->add($viewOwnerAcitvity);
        $authManager->addChild($user,$createActivity);
        $authManager->addChild($user,$viewOwnerAcitvity);
        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$viewAllAcitvity);
        $authManager->assign($user,4);
        $authManager->assign($admin,3);
    }
    public function canCreateActivity(){
        return \Yii::$app->user->can('createActivity');
    }
    public function canViewActivity($activity){
        if(\Yii::$app->user->can('viewAllActivity')){
            return true;
        }
        if(\Yii::$app->user->can('viewOwnerActivity',['activity'=>$activity])){
            return true;
        }
        return false;
    }
}