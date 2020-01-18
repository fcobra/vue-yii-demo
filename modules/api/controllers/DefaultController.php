<?php

namespace app\modules\api\controllers;

use app\modules\api\components\ApiModuleController;

/**
 * Default controller for the `api` module
 */
class DefaultController extends ApiModuleController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return ['message' => true];
    }
}
