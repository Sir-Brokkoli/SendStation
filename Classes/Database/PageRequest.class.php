<?php namespace Sendstation\Database;

/**
 * Contains all paging details for a database page request.
 */
class PageRequest {

    private int $pageNumber;
    private int $pageSize;

    private function __construct(int $pageNumber, int $pageSize) {

        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
    }

    public function of($pageNumber, $pageSize) : PageRequest {

        return new PageRequest($pageNumber, $pageSize);
    }
}

?>