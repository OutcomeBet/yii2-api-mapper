<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\components;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use outcomebet\apimapper\exception\ConfigException;
use outcomebet\apimapper\exception\HandlerInterfaceException;
use outcomebet\apimapper\exception\NotFoundMapperException;
use outcomebet\apimapper\exceptions\RuntimeException;
use outcomebet\apimapper\hanlers\HandlerInterface;
use outcomebet\apimapper\Module;
use outcomebet\apimapper\transport\adapters\AdapterInterface;
use yii\base\Component;
use yii\base\Model;

/**
 * Class Mapper
 * @package outcomebet\apimapper\components
 */
class Mapper extends Component
{
    /**
     * Возвращает массив конфигурации mapper'a по ключу
     * @param string $key
     * @return array
     */
    protected function getMapper($key)
    {
        $mapping = $this->getModule()->getMappers();
        if (!is_array($mapping) || count($mapping) === 0) {
            throw new ConfigException('Mapping section in config file is invalid');
        }
        if (!array_key_exists($key, $mapping)) {
            throw new NotFoundMapperException(sprintf('Mapper with key %s not found', $key));
        }
        return $mapping[$key];
    }

    /**
     * Подготавливает adapter для отправки данных
     * @param array $adapter
     * @return object
     */
    protected function configureAdapter($adapter)
    {
        if (!array_key_exists('class', $adapter) || !$adapter['class']) {
            throw new ConfigException('Key "class" not found in adaper');
        }
        $class = $adapter['class'];
        unset($adapter['class']);
        if (!array_key_exists('url', $adapter) || !$adapter['url']) {
            $transport = $this->getModule()->getTransport();
            if (!array_key_exists('url', $transport) || !$transport['url']) {
                throw new ConfigException('Api url not defined in adapter and transport configuration sections');
            }
            $adapter['url'] = $transport['url'];
        }
        return \Yii::createObject($class, [$adapter]);
    }

    /**
     * Возвращает экземпляр класса Module
     * @return Module
     */
    protected function getModule()
    {
        return \Yii::$app->getModule('apiMapper');
    }


    /**
     * Осуществляет заполнение данными модели
     * @param array $data
     * @param string $modelClass
     * @param string | null $handlerClass
     * @return Model | ArrayCollection
     * @throws HandlerInterfaceException
     */
    public function fill($data, $modelClass, $targetClass = null, $handlerClass = null)
    {
        /** @var Model | ArrayCollection $model */
        $model = \Yii::createObject($modelClass);
        if ($handlerClass) {
            $handler = \Yii::createObject($handlerClass);
            if (!$handler instanceof HandlerInterface) {
                throw new HandlerInterfaceException(
                    sprintf('Handler must implement HandlerInterface! (%s)', $handlerClass)
                );
            }
            $data = $handler->handle($data);
        }
        if ($model instanceof Collection) {
            if (!$targetClass) {
                throw new RuntimeException('Target class must be specified when model implements collection interface');
            }
            foreach ($data as $item) {
                $target  = \Yii::createObject($targetClass);
                if (!is_array($item)) {
                    $item = (array)$item;
                }
                if (!$target->load($item, '')) {
                    throw new RuntimeException('Invalid data for loading into model.');
                }
                $model->add($target);
            }
        } else {
            if (!is_array($data)) {
                $data = (array)$data;
            }
            if (!$model->load($data, '')) {
                throw new RuntimeException('Invalid data for loading into model.');
            }
        }
        return $model;
    }

    /**
     * Осуществляет чтение данных из API и пишет их непосредственно
     * в модель
     * @param string  $key
     */
    public function read($key, $options = [])
    {
        $mapper = $this->getMapper($key);
        if (!array_key_exists('adapter', $mapper) || !$mapper['adapter']) {
            throw new ConfigException(sprintf('Key "adapter" for mapper %s not found', $key));
        }
        /** @var AdapterInterface $adapter */
        $adapter = $this->configureAdapter($mapper['adapter']);
        $data = $adapter->read($options);
        if (!array_key_exists('model', $mapper) || !$mapper['model']) {
            throw new RuntimeException(sprintf('In section %s not specified model class', $mapper['model']));
        }
        $handlerClass = array_key_exists('handler', $mapper) && $mapper['handler'] ? $mapper['handler'] : null;
        $targetClass = array_key_exists('target', $mapper) && $mapper['target'] ? $mapper['target'] : null;
        return $this->fill($data, $mapper['model'], $targetClass, $handlerClass);
    }
}
