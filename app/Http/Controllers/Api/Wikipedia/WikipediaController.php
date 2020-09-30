<?php

namespace App\Http\Controllers\Api\Wikipedia;

use App\Http\Controllers\Controller;
use App\WikipediaApi\Contracts\IWikipediaService;
use Illuminate\Http\Request;

class WikipediaController extends Controller
{
    public function get(string $terms, IWikipediaService $wikipediaService)
    {
        try {
            if (!$terms || empty($terms))
                throw new \Exception('Missing terms params, please provide terms in the url', 400);

            $articles = $wikipediaService->get10Articles($terms);
            return response(['articles' => $articles], 200);
        }
        catch (\Throwable $exception) {
            return response(['errors' => [$exception->getMessage()]], 500);
        }
    }
}
