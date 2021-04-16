<?php

namespace Holidays\Handlers;

class File implements HandlerInterface
{
    /**
     * parses the input string and returns a php array
     *
     * @param string holiday data
     * @return array
     */
    public function parse(string $str): array
    {
        return json_decode($str, true);
    }
}
