<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobemesin',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'elektro' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobeelektro',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'kimia' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobekimia',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'sipil' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobesipil',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'industri' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobeindustri',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'pwk' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=dbobepwk',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
