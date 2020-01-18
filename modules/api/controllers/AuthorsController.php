<?php

namespace app\modules\api\controllers;

use app\models\News;
use app\modules\api\components\ApiModuleController;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;

/**
 * Default controller for the `api` module
 */
class AuthorsController extends ApiModuleController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return \Yii::$app->params['authors'];
    }
}
