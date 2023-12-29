<?php

declare(strict_types=1);

class SearchController extends \Search
{
    private string $search_input;

    public function __construct(string $search_input)
    {
        $this->search_input = $search_input;
    }

    public function searchResults()
    {
        $this->getUsersBySearch($this->search_input);
    }
}
