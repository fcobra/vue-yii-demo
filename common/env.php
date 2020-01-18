<?php
/**
 * Require helpers
 */

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (!function_exists('env')) {
    function env($key, $default = null)
    {

        $value = getenv($key);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;
        }

        return $value;
    }
}

/**
 * Load application environment from .env file
 */
$dotEnv = new \Dotenv\Dotenv(dirname(__DIR__));
$dotEnv->load();

/**
 * Init application constants
 */
defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'prod'));

