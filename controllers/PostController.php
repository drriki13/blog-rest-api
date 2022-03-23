<?php

namespace app\controllers;

use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => '\yii\filters\Cors',
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class
        ];

        return $behaviors;
    }

    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                return new ActiveDataProvider(
                    [
                        'query' => $this->modelClass::find()->with('category'),
                        'pagination' => [
                            'pageSize' => 20,
                        ],
                    ]
                );
            },
        ];

        return $actions;
    }


}
