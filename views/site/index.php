<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::$app->name ?></h1>
    </div>

    <div class="body-content">

        <div id="vue_app">
            <router-view></router-view>
        </div>

    </div>
</div>
