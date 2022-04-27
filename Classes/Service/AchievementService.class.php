<?php namespace Sendstation\Service;

class AchievementService {

    private Repository $repository;

    public function __construct() {

        $repository = null;
    }

    public function findAll() :array {

        return array();
    }

    public function findPage(PageRequest $pageRequest) :Page {

        return null;
    }

    public function findAchievementById(int $id) :Entity {

        return null;
    }
}

?>