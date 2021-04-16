<?php

namespace Holidays\Clients;

interface ClientInterface
{
    /**
     * Returns holidays of a given year as a string
     *
     * @param  int year
     * @return string
     */
    public function fetch(int $year): string;
}
