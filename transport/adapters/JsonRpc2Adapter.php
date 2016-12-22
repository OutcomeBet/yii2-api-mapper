<?php
/**
 * @project yii2-api-mapper
 * @author Deller <deller@inbox.ru>
 */

namespace outcomebet\apimapper\transport\adapters;


use nizsheanez\jsonRpc\Client;

class JsonRpc2Adapter extends AbstractAdapter implements AdapterInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $method;

    /**
     * @param array $options
     * @return mixed
     */
    public function read(array $options = [])
    {
        $data = call_user_func([$this->getClient(), $this->getMethod()], $options);
        return $data;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if(!$this->client) {
            $this->client = \Yii::createObject(Client::class, [$this->getUrl()]);
        }
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function init()
    {
        // TODO: Implement init() method.
    }
}