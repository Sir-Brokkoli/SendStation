<?php namespace Sendstation\Sessions;

require_once 'Classes/Sessions/Model/Session.php';
require_once 'Classes/Database/IRepository.php';

use Sendstation\Sessions\Model\Session;

use Sendstation\Database\IRepository;

/**
 * Interface extension of a crud repository for a repository concerning session entities.
 */
interface ISessionRepository extends IRepository {
    public function findActiveSessionByClimber($climberId) :?Session;
}
?>