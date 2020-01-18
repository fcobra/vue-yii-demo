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
class NewsController extends ApiModuleController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return News::find()->orderBy(['date' => SORT_DESC])->limit(10)->asArray()->all();
    }

    public function actionLoad($id){
        $model = News::find()->andWhere(['id' => (int)$id])->asArray()->one();
        if($model){
            return $model;
        }
    }

    public function actionCreate(){
        $post = Json::decode( \Yii::$app->request->rawBody);
        $title = ArrayHelper::getValue($post, 'title');
        $author_id = ArrayHelper::getValue($post, 'author_id');
        $text = ArrayHelper::getValue($post, 'text');

        $model = new News();
        $model->setAttributes([
            'title' => $title,
            'author_id' => $author_id,
            'text' => $text,
            'date' => date('Y-m-d H:i:s')
        ]);

        $response = '';

        if(!$model->save()){
            $response = ['error' => 1, 'errors' => $model->getErrors()];
        }

        return $response;
    }
}
