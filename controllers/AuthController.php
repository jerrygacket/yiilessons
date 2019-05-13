<?php


namespace app\controllers;

use app\controllers\actions\AuthSignInAction;
use app\controllers\actions\AuthSignUpAction;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actions()
    {
        return [
            'signup'=>['class'=>AuthSignUpAction::class],
            'signin'=>['class'=>AuthSignInAction::class],
        ];
    }
}