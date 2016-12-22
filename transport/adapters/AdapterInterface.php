<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\transport\adapters;

/**
 * Interface AdapterInterface
 * @package outcomebet\apimapper\transport\adapters
 */
interface AdapterInterface
{
    /**
     * Читает данные и возвращает в виде массива или объекта
     * @return array | \stdClass
     */
    public function read();
}
