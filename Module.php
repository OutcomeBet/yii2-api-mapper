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
    public $mappers;

    /**
     * @var array
     */
    public $transport;


    public function init()
    {
        parent::init();
        \Yii::$app->set('apiMapper', [
            'class' => Mapper::class]);
    }

    /**
     * @return array
     */
    public function getMappers()
    {
        return $this->mappers;
    }

    /**
     * @param array $mappers
     */
    public function setMappers($mappers)
    {
        $this->mappers = $mappers;
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
