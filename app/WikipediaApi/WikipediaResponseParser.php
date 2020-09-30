<?php


namespace App\WikipediaApi;


use App\WikipediaApi\Contracts\IWikipediaResponseParser;
use App\WikipediaApi\Exception\WikipediaException;

class WikipediaResponseParser implements IWikipediaResponseParser
{
    /**
     * @inheritdoc
     */
    public function parseResponse($responseStr)
    {
        if (!$responseStr || empty($responseStr))
            throw new WikipediaException('Empty response from wikipedia api', 500);

        $jsonObject = json_decode($responseStr);

        if (!$jsonObject)
            throw new WikipediaException('Invalid response from wikipedia api', 500);

        if (!isset($jsonObject->query->search))
            return [];

        return $jsonObject->query->search;
    }
}
