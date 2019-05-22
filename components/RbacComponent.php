<?php
namespace app\components;

use app\rules\ViewOwnerActivityRule;
use app\rules\ViewOwnerProfileRule;
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
        $viewAllActivity = $authManager->createPermission('viewAllActivity');
        $viewAllActivity->description='Просмотр любых активностей';

        $viewAllProfiles = $authManager->createPermission('viewAllProfiles');
        $viewAllProfiles->description='Просмотр любых профилей';

        $viewOwnerActivityRule = new ViewOwnerActivityRule();
        $authManager->add($viewOwnerActivityRule);

        $viewOwnerActivity=$authManager->createPermission('viewOwnerActivity');
        $viewOwnerActivity->description='Просмотр только своих активностей';
        $viewOwnerActivity->ruleName=$viewOwnerActivityRule->name;

        $viewOwnerProfileRule = new ViewOwnerProfileRule();
        $authManager->add($viewOwnerProfileRule);
        $viewOwnerProfile=$authManager->createPermission('viewOwnerProfile');
        $viewOwnerProfile->description='Просмотр только своего профиля';
        $viewOwnerProfile->ruleName=$viewOwnerProfileRule->name;

        $authManager->add($createActivity);
        $authManager->add($viewAllActivity);
        $authManager->add($viewAllProfiles);
        $authManager->add($viewOwnerActivity);
        $authManager->add($viewOwnerProfile);

        $authManager->addChild($user,$createActivity);
        $authManager->addChild($user,$viewOwnerActivity);
        $authManager->addChild($user,$viewOwnerProfile);

        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$viewAllActivity);
        $authManager->addChild($admin,$viewAllProfiles);

        $authManager->assign($user,1);
        $authManager->assign($admin,2);
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

    public function canViewProfile($profile){
        if(\Yii::$app->user->can('viewAllProfiles')){
            return true;
        }
        if(\Yii::$app->user->can('viewOwnerProfile',['profile'=>$profile])){
            return true;
        }
        return false;
    }
}