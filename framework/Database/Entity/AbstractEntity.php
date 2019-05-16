<?php

namespace Framework\Database\Entity;

use Framework\Database\Entity\SchemaParameter;

abstract class AbstractEntity
{
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
        if (self::$schemaWithDbNameAsKey) {
            return self::$schemaWithDbNameAsKey;
        }

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
        $schemaParameter = self::getSchemaWithDbNameAsKey()[$columName];

        if (!$schemaParameter) {
            throw new \Exception('The column "' . $columName . '" doesn\'t exist on "' . static::class . '"');
        }

        return 'set' . ucfirst($schemaParameter->getParameterName());
    }

    public function __get($property)
    {
        $field = 'get' . ucfirst($property);
        
        return $this->$field();
    }

}