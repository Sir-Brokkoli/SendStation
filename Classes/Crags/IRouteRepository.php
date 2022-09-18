<?php
namespace Sendstation\Crags;

require_once 'Classes/Database/IRepository.php';

use Sendstation\Database\IRepository;

/**
 * Interface extension of a crud repository for a repository concerning route entities.
 */
interface IRouteRepository extends IRepository {
    function findByCrag($cragId);
    function deleteByCrag($cragId);
}
?>