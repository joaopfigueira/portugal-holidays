<?php

namespace Holidays\Handlers;

interface HandlerInterface
{
    /**
     * parses the input string and returns a php array
     *
     * @param string holiday data
     * @return array
     */
    public function parse(string $str): array;
}
