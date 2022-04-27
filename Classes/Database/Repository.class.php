<?php namespace Sendstation\Database;

class Repository {

    private $entityName;
    private $tableName;
    private $entityXML;

    private $connectionMySQL;

    public function __construct($connectionMySQL, $entityXML){

        $this->entityXML = $entityXML;
        $this->entityName = $entityXML['name'];
        $this->tableName = $entityXML['tablename'];

        $this->connectionMySQL = $connectionMySQL;
    }

    public function tableName() :string {

        return $this->tableName;
    }

    public function initialize($entityXML) :bool {

        $tableInit = XMLTableParser::parseEntityInitialization($entityXML);
        $sql = "CREATE TABLE IF NOT EXISTS {$this->tableName} ({$tableInit});";

        return $this->executeQuery($sql, $out);
    }

    public function findAll() :array {

        $sql = "SELECT * FROM {$this->tableName}";
        $this->executeQuery($sql, $out);

        $result = array();

        while ($data = $out->fetch_assoc()) {

            $entity = new Entity($data);
            array_push($result, $entity);
        }

        return $result;
    }

    public function findPage(PageRequest $pageRequest) :Page {

        $sql = "SELECT * FROM {$this->tableName} LIMIT ?, ?";
        $this->executeQuery($sql, $out, $pageRequest->getOffset(), $pageRequest->getPageSize() + 1);

        $result = array();
        $hasNext = $out->num_rows > $pageRequest->getPageSize();

        $i = 0;
        while ($data = $out->fetch_assoc() && $i++ < $pageRequest->getPageSize()) {

            $entity = new Entity($data);
            array_push($result, $entity);
        }

        return new Page($pageRequest, $result, $hasNext);
    }

    public function findPageSorted(PageRequest $pageRequest, string $sorting, bool $descending = true) :Page {

        $sql = "SELECT * FROM {$this->tableName} LIMIT ?, ? ORDER BY ? " . ($descending ? "DESC" : "ASC");
        $this->executeQuery($sql, $out, $pageRequest->getOffset(), $pageRequest->getPageSize() + 1, $sorting);

        $result = array();
        $hasNext = $out->num_rows > $pageRequest->getPageSize();

        $i = 0;
        while ($data = $out->fetch_assoc() && $i++ < $pageRequest->getPageSize()) {

            $entity = new Entity($data);
            array_push($result, $entity);
        }

        return new Page($pageRequest, $result, $hasNext);
    }

    public function findBy(array $attributes) :Entity {

        $values = array();

        $sql = "SELECT * FROM {$this->tableName} WHERE ";
        foreach ($attributes as $attr => $value) {

            $sql .= "{$attr} = ?,";
            array_push($values, $value);
        }
        $sql = \substr_replace($sql, "", -1);

        $this->executeQuery($sql, $out, $values);
        $data = $out->fetch_assoc();

        return new Entity($data);
    }

    public function insert(Entity $entity) :Entity {

        $sql = "INSERT INTO {$this->tableName} () VALUES ()";

        return $entity;
    }

    public function update(Entity $entity) :Entity {

        return $entity;
    }

    public function executeQuery($sql, &$out, ... $params) :bool {

        $stmt = $this->connectionMySQL->prepare($sql);
        $stmt->bind_param(\str_repeat("s",\count($params)), ... $params);
        $success = $stmt->execute();

        $out = $stmt->get_result();
        $stmt->close();

        return $success;
    }
}

?>