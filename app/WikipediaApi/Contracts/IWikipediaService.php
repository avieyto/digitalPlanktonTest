<?php


namespace App\WikipediaApi\Contracts;


interface IWikipediaService
{
    /**
     * Retrieve 10 articles from wikipedia based on a keyword
     * @param string $keyword
     * @return array
     */
    function get10Articles(string $keyword);

    /**
     * Make a request to the wikipedia api and retrieve articles
     * @param IWikipediaRequest $retrieveModel
     * @return array
     */
    function makeRequest(IWikipediaRequest $retrieveModel);
}
