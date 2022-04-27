<?php namespace Sendstation\Authentication;

use Sendstation\Database\Repository;

class AuthenticationService {

    private static Repository $userRepository;

    public static function hasAdminAuthority() :bool {
        
        \session_start();
        $id = $_SESSION['id'];

        $sql = "SELECT COUNT(*) AS admin FROM (SELECT * FROM {self::$userRepository->tableName()} WHERE id=? AND admin=1) AS res";

        return self::$userRepository->executeQuery($sql, $out, $id) && $out->fetch_assoc()['admin'] == 1;
    }

    public static function hasManagerAuthority() :bool {

        \session_start();
        $id = $_SESSION['id'];

        $sql = "SELECT COUNT(*) AS manager FROM (SELECT * FROM {self::$userRepository->tableName()} WHERE id=? AND manager=1) AS res";

        return self::$userRepository->executeQuery($sql, $out, $id) && $out->fetch_assoc()['manager'] == 1;
    }
}

?>