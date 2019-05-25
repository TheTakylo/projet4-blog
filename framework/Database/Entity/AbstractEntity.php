<?php

namespace Framework\Database\Entity;

use Countable;

abstract class AbstractEntity implements Countable
{

    public $other;

    /**
     * @var SchemaParameter[]
     */
    static private $schemaWithDbNameAsKey;

    /**
     * @return string
     */
    abstract static public function getTableName(): string;

    /**
     * @return SchemaParameter[]
     */
    abstract static public function getSchema(): array;

    /**
     * @return array
     */
    static public function getSchemaWithDbNameAsKey(): array
    {
        self::$schemaWithDbNameAsKey = [];
        foreach (static::getSchema() as $value) {
            self::$schemaWithDbNameAsKey[$value->getColumnName()] = $value;
        }

        return self::$schemaWithDbNameAsKey;
    }

    /**
     * @param string $columName
     * @return string
     *
     * @throws \Exception
     */
    static public function getSetterNameFromColumName(string $columName): string
    {
        /** @var SchemaParameter $schemaParameter */
        $schemaParameter = @self::getSchemaWithDbNameAsKey()[$columName];

        if (!$schemaParameter) {
            return 'other';
        }

        return 'set' . ucfirst($schemaParameter->getParameterName());
    }

    public function __get($property)
    {
        $field = 'get' . ucfirst($property);
        
        return $this->$field();
    }

    public function count() {
        return 1;
    }


    /**
     * Get the value of other
     */ 
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set the value of other
     *
     * @return  self
     */ 
    public function addOther($other, $value)
    {
        $this->other[$other] = $value;

        return $this;
    }
}