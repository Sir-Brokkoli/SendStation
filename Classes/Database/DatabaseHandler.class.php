<?php namespace Sendstation\Database;

include_once 'Repository.class.php';

class DatabaseHandler {

    private $connectionMySQL;

    private $databaseConfigXML;
    private array $repositories;

    public function __construct(string $pathXML) {

        if ($this->databaseConfigXML = \simplexml_load_file($pathXML)) {

            $this->initRepositories();
        }
        else {

            die("Unable to initialize database!");
        }
    }

    public function initRepositories() :void {

        $this->repositories = array();

        foreach ($this->databaseConfigXML->children() as $entityXML) {

            $repository = new Repository($this->connectionMySQL, $entityXML);
            $this->repositories[$entityXML->name] = $repository;
        }
    }

    public function getRepository(string $entityName) {

        return $this->repositories[$entityName];
    }
}