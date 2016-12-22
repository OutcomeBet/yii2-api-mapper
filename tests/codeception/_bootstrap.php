<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

$vendor = __DIR__.'/../../vendor';
define('VENDOR_DIR', $vendor);

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'test');
require_once VENDOR_DIR.'/autoload.php';
require(VENDOR_DIR . '/yiisoft/yii2/Yii.php');

// TODO: remove this shitty hack
// without following line test on travis fails
require_once VENDOR_DIR.'/yiisoft/yii2/base/ErrorException.php';


\Yii::setAlias('@tests', __DIR__);
\Yii::setAlias('@data', __DIR__ . DIRECTORY_SEPARATOR . "/_data/");
