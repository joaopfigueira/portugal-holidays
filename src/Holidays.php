<?php

namespace Holidays;

use Holidays\Clients\ClientInterface;
use Holidays\Handlers\HandlerInterface;

class Holidays
{
    /**
     * @var array
     */
    private $result = [];

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var HandlerInterface
     */
    private $handler;

    public function __construct(ClientInterface $client, HandlerInterface $handler)
    {
        $this->client  = $client;
        $this->handler = $handler;
    }

    /**
     * calls client and parser dependencies and sets $results
     *
     * @param array array of integers year
     * @param string holidays type optional
     */
    public function get(array $years, ?string $type = null)
    {
        foreach ($years as $year) {
            $fetch  = $this->client->fetch($year);
            $parsed = $this->handler->parse($fetch);

            $filter = $type ? $this->filter($parsed, $type) : $parsed;

            $this->result = array_merge($this->result, $filter);
        }

        return $this;
    }

    /**
     * returns results as array
     *
     * @return array
     */
    public function asArray(): array
    {
        return $this->result;
    }

    /**
     * returns results as json string
     *
     * @return string
     */
    public function asJson(): string
    {
        return json_encode($this->result);
    }

    /**
     * returns results as csv string
     *
     * @return string
     */
    public function asCsv(): string
    {
        $csv = '';
        foreach ($this->result as $holiday) {
            $csv .= implode(',',$holiday);
            $csv .= "\n";
        }

        return $csv;
    }

    /**
     * get client object and gives direct access
     *
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Filter holidays array by type
     *
     * @param  array
     * @param  string
     * @return array
     */
    private function filter(array $parsed, string $type): array
    {
        return array_filter($parsed, function($arr) use($type){
            return $arr['type'] === $type;
        });
    }
}
