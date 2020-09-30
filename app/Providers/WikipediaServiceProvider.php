<?php

namespace App\Providers;

use App\WikipediaApi\Contracts\IWikipediaApiClient;
use App\WikipediaApi\Contracts\IWikipediaRequest;
use App\WikipediaApi\Contracts\IWikipediaResponseParser;
use App\WikipediaApi\Contracts\IWikipediaService;
use App\WikipediaApi\WikipediaApiClient;
use App\WikipediaApi\WikipediaRequest;
use App\WikipediaApi\WikipediaResponseParser;
use App\WikipediaApi\WikipediaService;
use Illuminate\Support\ServiceProvider;

class WikipediaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IWikipediaApiClient::class, WikipediaApiClient::class);
        $this->app->bind(IWikipediaRequest::class, WikipediaRequest::class);
        $this->app->bind(IWikipediaService::class, WikipediaService::class);
        $this->app->bind(IWikipediaResponseParser::class, WikipediaResponseParser::class);
    }
}
