<?php namespace Sendstation\Service;

class ContactService {

    private Repository $repository;

    public function __construct() {

        $repository = null;
    }

    public function findAll() :array {

        return $this->repository->findAll();
    }

    public function findPage(PageRequest $pageRequest, string $sorting = null, bool $descending = true) :Page {

        return $this->repository->findPageSorted($pageRequest, $sorting, $descending);
    }

    public function findMessageById(int $id) :Entity {

        $sql = "SELECT * FROM {$this->repository->tableName()} WHERE id=?";

        $out = null;
        if (!$this->repository->executeQuery($sql, $out, $id)) {

            return null;
        }

        return new Entity($out->fetch_assoc());
    }

    public function addMessage(string $message) :bool {

        $sql = "INSERT INTO {$this->repository->tableName()} (message) VALUES (?)";

        return $this->repository->executeQuery($sql, $out, $message);
    }
}

?>