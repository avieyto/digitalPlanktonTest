<?php

namespace Tests\Unit;

use App\WikipediaApi\WikipediaApiClient;
use App\WikipediaApi\WikipediaResponseParser;
use App\WikipediaApi\WikipediaService;
use PHPUnit\Framework\TestCase;

class WikipediaServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRetrieve10ArticlesFromWikipediaApi()
    {
        $apiClient = new WikipediaApiClient();
        $responseParser = new WikipediaResponseParser();
        $service = new WikipediaService($apiClient, $responseParser);
        $articles = $service->get10Articles('usa');
        $this->assertTrue(count($articles) == 10);
    }
}
