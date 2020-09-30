<?php


namespace App\WikipediaApi\Contracts;


use phpDocumentor\Reflection\Types\Boolean;

interface IWikipediaApiClient
{
    /**
     * Make a request to the wikipedia api
     * @param string $keyword terms to find the articles
     * @param string $action default query
     * @param string $format default json
     * @param string $list default search
     * @param bool $utf8 default true
     * @param string $origin
     * @return string
     */
    function makeRequest(string $keyword, string $action = 'query', string $format = 'json', string $list = 'search', bool $utf8 = true, string $origin = '*');
}
