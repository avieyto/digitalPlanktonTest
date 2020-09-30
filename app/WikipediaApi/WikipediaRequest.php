<?php


namespace App\WikipediaApi;

use App\WikipediaApi\Contracts\IWikipediaRequest;

/**
 * Class WikipediaRetrieveModel
 * @package App\WikipediaApi
 * @property string $action
 * @property string $format
 * @property string $list
 * @property boolean $utf8
 * @property string $searchTerms
 * @property string $origin
 */
class WikipediaRequest implements IWikipediaRequest
{
    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * @return bool
     */
    public function getUtf8()
    {
        return $this->utf8;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return string
     */
    function getSearchTerms()
    {
        return $this->searchTerms;
    }
}
