<?php namespace Sendstation\Service;

class CragService {

    private Repository $cragRepository;
    private Repository $routeRepository;

    public function __construct() {

        $this->repository = null;
    }

    public function findAll() :array {

        return $this->cragRepository->findAll();
    }

    public function findPage(PageRequest $pageRequest) :Page {

        return $this->cragRepository->findPage($pageRequest);
    }

    public function findCragById(int $id) :Entity {

        return $this->cragRepository->findBy(['id' => $id]);
    }

    public function findRoutes(int $cragId) :array {

        return $this->routeRepository->findBy(['id_crag' => $cragId]);
    }

    public function findRouteById(int $id) :Entity {

        return $this->routeRepository->findBy(['id' => $id]);
    }
}

?>