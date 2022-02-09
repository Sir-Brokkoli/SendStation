<?php namespace Sendstation\Database;

/**
 * A page of entities fetched from the database.
 */
class Page {

    private PageRequest $pageRequest;
    private array $content;

    public function __construct(PageRequest $pageRequest, array $content) {

        $this->pageRequest = $pageRequest;
        $this->content = $content;
    }

    public function getPageRequest() : PageRequest {

        return $this->pageRequest;
    }

    public function getContent() : array {

        return $this->content;
    }
}

?>