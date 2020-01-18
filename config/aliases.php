<?php

return [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
    '@commands' => str_replace(['/','\\'], DIRECTORY_SEPARATOR, dirname(__FILE__).'/../commands/')
];