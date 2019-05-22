<?php

$mailer=[
            'class' => 'yii\swiftmailer\Mailer',
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'timmykry@yandex.ru',
                'password' => 'Njhf,erf38',
                'port' => 587,
                'encryption' => 'tls'
            ]
        ];

return $mailer;
