<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\transport\adapters;
use outcomebet\apimapper\transport\exceptions\RuntimeException;

/**
 * Class AbstractAdapter
 * @package outcomebet\apimapper\transport\adapters
 */
abstract class AbstractAdapter
{
    /**
     * @var array
     */
    protected $url;

    /**
     * AbstractAdapter constructor.
     */
    public function __construct(array $config = [])
    {
        if(!array_key_exists('url', $config) || !$config['url']) {
            throw new RuntimeException('Url not defined');
        }
        $this->setUrl($config['url']);
    }

    /**
     * @return mixed
     */
    abstract public function init();

    /**
     * @return array
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param array $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }



}