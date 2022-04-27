<?php namespace Sendstation\Service;

class SessionService {

    private Repository $sessionRepository;

    public function __construct() {

        $repository = null;
    }

    public function findAll() :array {

        return $this->sessionRepository->findAll();
    }

    public function findPage(PageRequest $pageRequest) :Page {

        return $this->sessionRepository->findPage($pageRequest);
    }

    public function findSessionById(int $id) :Entity {

        return $this->sessionRepository->findBy(['id' => $id]);
    }

    public function findActiveSessionFor(int $userId) :Entity {

        return $this->sessionRepository->findBy(['id' => $userId, 'is_active' => 1]);
    }

    public function hasSendGo(int $climberId, int $routeId) :bool {

        $sql = "SELECT COUNT(*) as send FROM (SELECT * FROM {$this->sessionRepository->tableName()} AS s 
                JOIN {$this->goRepository->tableName()} AS g ON g.id_session = s.id 
                WHERE s.id_climber=? AND g.id_route=? AND g.send=1) AS res";

        return $this->sessionRepository->executeQuery($sql, $out, $climberId, $routeId) && $out->fetch_assoc()['send'] >= 1;
    }

    public function hasTopropeGo($climberId, $routeId) :bool {

        $sql = "SELECT COUNT(*) as toprope FROM (SELECT * FROM {$this->sessionRepository->tableName()} AS s 
                JOIN {$this->goRepository->tableName()} AS g ON g.id_session = s.id 
                WHERE s.id_climber=? AND g.id_route=? AND g.toprope=1) AS res";

        return $this->sessionRepository->executeQuery($sql, $out, $climberId, $routeId) && $out->fetch_assoc()['toprope'] >= 1;
    }
}

?>