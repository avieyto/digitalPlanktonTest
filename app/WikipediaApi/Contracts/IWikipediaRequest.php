<?php


namespace App\WikipediaApi\Contracts;

/**
 * Interface IWikipediaRequest
 * @package App\WikipediaApi\Contracts
 */
interface IWikipediaRequest
{
    /**
     * Format to retrieve data from wikipedia api
     * @return string
     */
    function getFormat();

    /**
     * Action to execute in a wikipedia request
     * @return string
     */
    function getAction();

    /**
     * Format to display articles
     * @return string
     */
    function getList();

    /**
     * Active or not to retrieve wikipedia in uff8 format
     * @return boolean
     */
    function getUtf8();

    /**
     * Find articles only in a certain location, example US
     * @return string
     */
    function getOrigin();

    /**
     * Retrieve articles with this term
     * @return string
     */
    function getSearchTerms();
}
