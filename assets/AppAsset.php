<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900',
        'https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css',
        'https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css'
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js',
        'https://unpkg.com/vue-router@3.1.5/dist/vue-router.js',
        'https://unpkg.com/axios/dist/axios.min.js',
        '/js/app.js'
    ];
    public $depends = [
        \yii\web\YiiAsset::class,
        \yii\bootstrap\BootstrapAsset::class,
    ];
}
