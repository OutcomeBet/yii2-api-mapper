<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\tests\codeception\unit;

use Doctrine\Common\Collections\ArrayCollection;
use outcomebet\apimapper\components\Mapper;
use outcomebet\apimapper\Module;
use outcomebet\apimapper\tests\codeception\models\TestModel;
use outcomebet\apimapper\transport\adapters\JsonRpc2Adapter;
use yii\codeception\TestCase;

/**
 * Class MapperTest
 * @package outcomebet\apimapper\tests\codeception\unit
 */
class MapperTest extends TestCase
{
    /**
     * @var Mapper
     */
    protected $mapper;

    public function setUp()
    {
        parent::setUp();
        \Yii::$app->getModule('apiMapper')->init();
        /** @var Mapper $mapper */
        $this->mapper = \Yii::$app->apiMapper;
    }

    /**
     *
     */
    public function testFillModelData()
    {
        $data = require_once \Yii::getAlias('@data') . '/testData.php';
        $model = $this->mapper->fill($data, TestModel::class);
        self::assertEquals(1, $model->id);
        self::assertEquals('Test', $model->name);
        self::assertNotEmpty($model->created_at);
    }

    /**\
     *
     */
    public function testCollectionFillData()
    {
        $data = require_once \Yii::getAlias('@data') . '/testCollectionData.php';
        $model = $this->mapper->fill($data, ArrayCollection::class, TestModel::class);
        self::assertInstanceOf(ArrayCollection::class, $model);
        self::assertInstanceOf(TestModel::class, $model->first());
        self::assertEquals(2, $model->last()->id);
    }

    public function testConfigureAdapter()
    {
        /** @var Module $module */
        $module = \Yii::$app->getModule('apiMapper');
        $mappers = $module->getMappers();
        $mapper = new \ReflectionClass(Mapper::class);
        $method = $mapper->getMethod('configureAdapter');
        $method->setAccessible(true);
        $adapter = $method->invokeArgs($this->mapper, [$mappers['test']['adapter']]);
        self::assertInstanceOf(JsonRpc2Adapter::class, $adapter);
        self::assertEquals('http://localhost/', $adapter->getUrl());
    }

    public function testGetMapper()
    {
        /** @var Module $module */
        $module = \Yii::$app->getModule('apiMapper');
        $mappers = $module->getMappers();
        $mapper = new \ReflectionClass(Mapper::class);
        $method = $mapper->getMethod('getMapper');
        $method->setAccessible(true);
        $mapperConfig = $method->invokeArgs($this->mapper, ['test']);
        self::assertTrue(is_array($mapperConfig));
        self::assertArrayHasKey('adapter', $mapperConfig);
        self::assertArrayHasKey('model', $mapperConfig);
    }
}
