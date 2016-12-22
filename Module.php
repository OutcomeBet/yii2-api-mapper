<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper;

use outcomebet\apimapper\components\Mapper;
use yii\base\Module as BaseModule;
/**
 * Class Module
 * @package outcomebet\apimapper
 */
class Module extends BaseModule
{
    /**
     * @var array
     */
    public $mapping;

    /**
     * @var array
     */
    public $transport;


    public function init()
    {
        parent::init();
        \Yii::$app->components['apiMapper'] = [
            'class' => Mapper::class
        ];
    }

    /**
     * @return array
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * @param array $mapping
     */
    public function setMapping($mapping)
    {
        $this->mapping = $mapping;
        return $this;
    }

    /**
     * @return array
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param array $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
        return $this;
    }
}