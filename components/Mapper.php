<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\components;

use outcomebet\apimapper\exception\ConfigException;
use outcomebet\apimapper\exception\NotFoundMapperException;
use outcomebet\apimapper\Module;
use yii\base\Component;

/**
 * Class Mapper
 * @package outcomebet\apimapper\components
 */
class Mapper extends Component
{

    protected function getMapper($key)
    {
        /** @var Module $module */
        $module = \Yii::$app->getModule('apiMapper');
        $mapping = $module->getMapping();
        if(!is_array($mapping) || count($mapping) === 0) {
            throw new ConfigException('Mapping section in config file is invalid');
        }
        if(!array_key_exists($key, $mapping)) {
            throw new NotFoundMapperException(sprintf('Mapper with key %s not found', $key));
        }
        return $mapping[$key];
    }

    protected function configureAdapter($adapter)
    {
        if(!array_key_exists('class',$adapter) || !$adapter['class']) {
            throw new ConfigException('Key "class" not found in adaper')
        }
        $class = $adapter['class'];
        unset($adapter['class']);
        return \Yii::createObject($class, [$adapter]);
    }

    /**
     * @param mixed  $key
     */
    public function read($key)
    {
        $mapper = $this->getMapper($key);
        if(!array_key_exists('adapter', $mapper) || !$mapper['adapter']) {
            throw new ConfigException(sprintf('Key "adapter" for mapper %s not found', $key));
        }
        $adapter = $this->configureAdapter($mapper['adapter']);
    }

}