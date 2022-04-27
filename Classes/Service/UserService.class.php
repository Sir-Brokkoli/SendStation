<?php namespace Sendstation\Service;

use Sendstation\Database\Entity;
use Sendstation\Database\Repository;
use Sendstation\Database\Page;
use Sendstation\Database\PageRequest;

use Sendstation\Authentication\LoginHandler;
use Sendstation\Authentication\AuthenticationService;

class UserService {

    private Repository $repository;

    public function __construct() {

        $this->repository = null;
        $this->authentication = null;
    }

    public function findAll() :array {

        return $this->repository->findAll();
    }

    public function findPage(PageRequest $pageRequest) :Page {

        if (!AuthenticationService::hasAdminAuthority()) {

            return null;
        }

        return $this->repository->findPage($pageRequest);
    }

    public function findUserById(int $id) :Entity {

        if (!AuthenticationService::hasAdminAuthority() && !LoginHandler::isLoggedUser($id)) {

            die();
            return null;
        }

        return $this->repository->findBy(['id' => $id]);
    }

    public function findUserByUsername(string $username) :Entity {

        return $this->repository->findBy(['nickname' => $username]);
    }
}

?>