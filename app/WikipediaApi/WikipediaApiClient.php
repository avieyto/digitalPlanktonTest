<?php


namespace App\WikipediaApi;

use App\WikipediaApi\Contracts\IWikipediaApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WikipediaApiClient implements IWikipediaApiClient
{
    /**
     * @var string $endpoint
     */
    protected $endpoint = 'https://en.wikipedia.org/w/api.php';

    public function __construct()
    {

    }

    /**
     * @inheritdoc
     * @throws GuzzleException
     */
    public function makeRequest(string $keyword, string $action = 'query', string $format = 'json', string $list = 'search', bool $utf8 = true, string $origin = '*')
    {
        $client = new Client();
        return $client->request('GET', $this->endpoint, [
            'query' => [
                'action' => $action,
                'format' => $format,
                'list' => $list,
                'utf8' => $utf8 ? '1' : '0',
                'origin' => $origin,
                'srsearch' => urlencode($keyword)
            ]
        ])->getBody()->getContents();
    }
}
