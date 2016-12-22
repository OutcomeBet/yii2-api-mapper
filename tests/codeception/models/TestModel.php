<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\tests\codeception\models;

use yii\base\Model;

/**
 * Class TestModel
 * @package outcomebet\apimapper\tests\codeception\models
 */
class TestModel extends Model
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
            [['created_at'], 'datetime']
        ];
    }
}
