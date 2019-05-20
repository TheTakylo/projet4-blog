<?php

namespace Framework\Database\Repository;

use App\Entity\Comment;
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
    
    public function findOne($conditions)
    {
        $item = $this->findWhere($conditions);
        
        return $item[0];
    }
    
    /**
    * @param int $id
    */
    public function findWhere($conditions, $orderBy = "")
    {
        $queryConditions = "";
        $queryData = [];
        
        foreach($conditions as $key => $value) {
            if($queryConditions != "") {
                $queryConditions .= " AND ";
            }
            
            $queryData[":value_{$key}"] = $value;
            $queryConditions .= " WHERE {$key} = :value_{$key} ";
        }
        
        $query = $this->db->prepare("SELECT * FROM {$this->getEntity()::getTableName()}  $queryConditions  ORDER BY id DESC");
        
        $query->execute($queryData);
        $data = $query->fetchAll();
        
        return $this->hydrateEntities($data);
    }
    
    public function remove($where, $value): bool
    {
        $query = $this->db->prepare("DELETE FROM {$this->getEntity()::getTableName()} WHERE {$where}= :where_value ");
        
        return $query->execute([':where_value' => $value]);
    }
    
    public function save(AbstractEntity $entity): bool
    {
        $schema = $entity::getSchemaWithDbNameAsKey();
        
        $data = [];
        $rows = "";
        $values = "";
        
        foreach($schema as $column) {
            $getter = 'get' . ucfirst($column->getColumnName());
            
            if($value = $entity->$getter()) {
                $rows .= " {$column->getColumnName()}, ";
                
                if($column->getType() === 'datetime') {
                    $value = $value->format('Y-m-d H:i:s');
                }                
                
                $data[':' . $column->getColumnName()] = $value;
            }
        }
        
        foreach($data as $row => $v) {
            $values .= " {$row}, ";
        }
        
        $rows  = substr($rows, 0, -2);
        $values = substr($values, 0, -2);
        
        $query = $this->db->prepare("INSERT INTO {$entity->getTableName()} ({$rows}) VALUES ({$values})");
        
        return $query->execute($data);
    }
    
    public function update($data, $conditions)
    {
        $queryConditions = "";
        $queryData = [];
        
        foreach($data as $key => $value) {
            if($queryConditions != "") {
                $queryConditions .= " AND ";
            }
            
            $queryData[":value_{$key}"] = $value;
            $queryConditions .= " SET {$key} = :value_{$key} ";
        }
        
        $query = $this->db->prepare("UPDATE {$this->getEntity()::getTableName()}  {$queryConditions}");
        
        return $query->execute($queryData);
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
    
    public function findLike($where, $value)
    {
        $query = $this->db->prepare("SELECT * FROM {$this->getEntity()::getTableName()} WHERE {$where} LIKE :where_value ORDER BY id DESC");
        
        $query->execute([':where_value' => "%{$value}%"]);

        return $this->hydrateEntities($query->fetchAll());
    }
    
    public function findAllJoin($entity, $join, $joinDest, $where = [], $limit = "")
    {
        $data = [];
        
        $tableName = $this->getEntity()::getTableName();
        $entity = new Comment();
        $relationName = $entity->getTableName();
        
        if($limit) {
            $data[':limit'] = (int) $limit;
        }
        
        $queryConditions = "";
        $queryData = [];
        
        foreach($where as $key => $value) {
            if($queryConditions != "") {
                $queryConditions .= " AND ";
            }
            
            $queryData[":value_{$key}"] = $value;
            $queryConditions .= " WHERE {$key} = :value_{$key} ";
        }
        
        $limit = ($limit) ? " LIMIT {$limit} " : "";
        
        
        $query = "SELECT {$tableName}.*, 
        COUNT(distinct {$relationName}.id) AS `{$relationName}_count`
        FROM {$tableName}
        LEFT JOIN {$entity->getTableName()} ON {$relationName}.{$joinDest} = {$tableName}.{$join}
        {$queryConditions}
        GROUP BY {$tableName}.id 
        ORDER BY {$tableName}.id DESC 
        {$limit} 
        ";
        
        $query  = $this->db->prepare($query);
        $query->execute($data);
        
        return $query->fetchAll();
    }
    
    private function hydrateEntities($datas)
    {
        if(!$datas) {
            return [];
        }
        
        return array_map(function ($data) {
            return $this->hydrateEntity($data);
        }, $datas);
    }
    
    /**
    * @return AbstractEntity
    *
    * @throws \Exception
    */
    private function hydrateEntity($datas): AbstractEntity
    {
        $className = $this->getEntity();
        $entity = new $className();
        foreach ($datas as $key => $value) {
            $setterName = $this->getEntity()::getSetterNameFromColumName($key);
            
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
        return $columName;
    }
}