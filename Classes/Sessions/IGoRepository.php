<?php namespace Sendstation\Sessions;

require_once 'Classes/Database/IRepository.php';

use Sendstation\Database\IRepository;

/**
 * Interface extension of a crud repository for a repository concerning go entities.
 */
interface IGoRepository extends IRepository {
    function findByRoute($routeId);
    function findBySession($sessionId);
    function findBySessionAndRoute($sessionId, $routeId);
    function findSendGoByClimberAndRoute($climberId, $routeId);
    function findTopropeSendGoByClimberAndRoute($climberId, $routeId);

    function deleteByRoute($routeId);
    function deleteBySession($sessionId);
    
    function accummulateGoesData($climberId);
    function accummulateSendCountPerCrag($climberId);
}
?>