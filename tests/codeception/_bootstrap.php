<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'autoload.php']);
require_once __DIR__ . implode(DIRECTORY_SEPARATOR, ['', '..', 'vendor', 'yiisoft', 'yii2', 'Yii.php']);
Yii::setAlias('@tests', __DIR__);
Yii::setAlias('@data', __DIR__ . DIRECTORY_SEPARATOR);
$dir = __DIR__;
$vendor = $dir . '/vendor';
define('VENDOR_DIR', $vendor);