<?php


namespace App\WikipediaApi;


use App\WikipediaApi\Contracts\IWikipediaApiClient;
use App\WikipediaApi\Contracts\IWikipediaRequest;
use App\WikipediaApi\Contracts\IWikipediaResponseParser;
use App\WikipediaApi\Contracts\IWikipediaService;
use App\WikipediaApi\Exception\WikipediaException;

class WikipediaService implements IWikipediaService
{
    /**
     * @var IWikipediaApiClient $wikipediaApiClient
     */
    protected $wikipediaApiClient;

    /**
     * @var IWikipediaResponseParser $wikipediaResponseParser
     */
    protected $wikipediaResponseParser;

    public function __construct(IWikipediaApiClient $apiClient, IWikipediaResponseParser $responseParser = null)
    {
        $this->wikipediaApiClient = $apiClient;
        if ($responseParser)
            $this->wikipediaResponseParser = $responseParser;
        else
            $this->wikipediaResponseParser = new WikipediaResponseParser();
    }

    /**
     * @param string $keyword
     * @return array|object|\stdClass|null
     * @throws WikipediaException
     */
    public function get10Articles($keyword)
    {
        $model = new WikipediaRequest();
        $model->action = 'query';
        $model->format = 'json';
        $model->list = 'search';
        $model->origin = '*';
        $model->searchTerms = $keyword;
        $model->utf8 = true;
        return $this->makeRequest($model);
    }

    /**
     * @param IWikipediaRequest $retrieveModel
     * @return array|object|\stdClass|null
     * @throws WikipediaException
     */
    public function makeRequest(IWikipediaRequest $retrieveModel)
    {
        $content = $this->wikipediaApiClient->makeRequest($retrieveModel->getSearchTerms(),
            $retrieveModel->getAction(),
            $retrieveModel->getFormat(),
            $retrieveModel->getList(),
            $retrieveModel->getUtf8(),
            $retrieveModel->getOrigin()
        );
        return $this->wikipediaResponseParser->parseResponse($content);
    }
}
