<?php
namespace Sendstation\Sessions;

/**
 * Interface extension of a crud repository for a repository concerning go entities.
 */
interface IGoRepository extends IRepository {
    function findByRoute($routeId);
    function findBySession($sessionId);
    function findBySessionAndRoute($sessionId, $routeId);
    function findSendGoByClimberAndRoute($climberId, $routeId);
    function findTopropeGoByClimberAndRoute($climberId, $routeId);

    function deleteByRoute($routeId);
    function deleteBySession($sessionId);
    
    function accummulateGoesData($climberId);
    function accummulateSendCountPerCrag($climberId, $cragId);
}
?>