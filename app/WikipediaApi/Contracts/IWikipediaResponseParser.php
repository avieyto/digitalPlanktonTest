<?php


namespace App\WikipediaApi\Contracts;


use App\WikipediaApi\Exception\WikipediaException;

interface IWikipediaResponseParser
{
    /**
     * @param $responseStr
     * @return \stdClass|object|null|array
     * @throws WikipediaException
     */
    function parseResponse($responseStr);
}
