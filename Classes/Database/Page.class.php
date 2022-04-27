<?php namespace Sendstation\Database;

/**
 * A page of entities fetched from the database.
 */
class Page {

    private PageRequest $pageRequest;
    private array $content;
    private bool $hasFollowingPage;

    public function __construct(PageRequest $pageRequest, array $content, bool $hasFollowingPage = false) {

        $this->pageRequest = $pageRequest;
        $this->content = $content;
        $this->hasFollowingPage = $hasFollowingPage;
    }

    public function getPageRequest() : PageRequest {

        return $this->pageRequest;
    }

    public function getContent() : array {

        return $this->content;
    }

    public function hasNext() :bool {

        return $this->hasFollowingPage;
    }
}

?>