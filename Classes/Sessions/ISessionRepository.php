<?php
namespace Sendstation\Sessions;

/**
 * Interface extension of a crud repository for a repository concerning session entities.
 */
interface ISessionRepository extends IRepository {
    function findActiveSessionByClimber($climberId);
}
?>