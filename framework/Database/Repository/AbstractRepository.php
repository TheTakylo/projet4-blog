<?php

namespace Framework\Database\Repository;

use Framework\Configuration\Store;
use Framework\Database\Entity\AbstractEntity;
use Framework\Database\Entity\SchemaParameter;

abstract class AbstractRepository
{

    private $db;

    public function __construct()
    {
        $this->db = Store::getInstance()->getDatabase();
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $req = $this->db->prepare('SELECT ' . $this->getColumsNameString() . ' FROM ' . $this->getEntity()::getTableName());
        $req->execute();

        return $this->hydrateEntities($req->fetchAll());
    }

    /**
     * @param int $id
     */
    public function find(int $id)
    {

    }

    public function count($where = null, $value = null): int
    {
        $data = [];

        if($where && $value) {
            $condition = "WHERE $where = :value";
            $data = [":value" => $value];
        }

        $req = $this->db->prepare('SELECT COUNT(id) as result FROM ' . $this->getEntity()::getTableName() . ' ' . $condition);
        $req->execute($data);

        return $req->fetch()->result;
    }

    /**
     * @return AbstractEntity[]
     */
    public function hydrateEntities($datas): array
    {
        return array_map(function ($data) {
            return $this->hydrateEntity($data);
        }, $datas);
    }

    /**
     * @return AbstractEntity
     *
     * @throws \Exception
     */
    public function hydrateEntity($datas): AbstractEntity
    {
        $className = $this->getEntity();
        $entity = new $className();
        foreach ($datas as $key => $value) {
            $temp = explode('_', $key, 2);

            
            $tableName = $temp[0];
            $columnName = $temp[1];
            
            if ($tableName !== $this->getEntity()::getTableName()) {
                // We could call the hydration of the other entity, for link
                continue;
            }
            
            $setterName = $this->getEntity()::getSetterNameFromColumName($columnName);
            
            $entity->$setterName($value);
        }
        
        return $entity;
    }

    /**
     * @return AbstractEntity
     */
    abstract protected function getEntity(): string;

    /**
     * @return string
     */
    protected function getColumsNameString()
    {
        $result = '';

        /** @var SchemaParameter $schemaParameters */
        foreach ($this->getEntity()::getSchema() as $schemaParameters) {
            if ($result !== '') {
                $result .= ', ';
            }

            $result .= $schemaParameters->getColumnName() . ' AS ' . $this->getAliasColumnName($schemaParameters->getParameterName());
        }

        return $result;
    }

    /**
     * @param string $columName
     * @return string
     */
    protected function getAliasColumnName(string $columName)
    {
        return $this->getEntity()::getTableName() . '_' . $columName;
    }
}