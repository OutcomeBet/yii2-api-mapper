<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\hanlers;

/**
 * Interface HandlerInterface
 * @package outcomebet\apimapper\hanlers
 */
interface HandlerInterface
{
    /**
     * Подгатовка данных для заполнения модели
     * @param array | object $data
     * @return array
     */
    public function handle($data);
}
