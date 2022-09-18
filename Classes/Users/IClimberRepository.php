<?php namespace Sendstation\Users;

require_once "Classes/Database/IRepository.php";

use Sendstation\Database\IRepository;

/**
 * Interface extension of a crud repository for a repository concerning climber entities.
 */
interface IClimberRepository extends IRepository {
    function findByEmail(string $email);
    function findByUsername(string $username);
}

?>