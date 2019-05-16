<?php

namespace Framework\Database\Entity;

class SchemaParameter
{
    /**
     * @var string
     */
    private $columnName;
    /**
     * @var string
     */
    private $parameterName;
    /**
     * @var string
     */
    private $type;

    /**
     * SchemaParameter constructor.
     * @param $dbName
     * @param $parameterName
     * @param $type
     */
    public function __construct(string $dbName, string $parameterName, string $type)
    {
        $this->columnName = $dbName;
        $this->parameterName = $parameterName;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getColumnName(): string
    {
        return $this->columnName;
    }

    /**
     * @param string $columnName
     * @return SchemaParameter
     */
    public function setColumnName(string $columnName): SchemaParameter
    {
        $this->columnName = $columnName;
        return $this;
    }

    /**
     * @return string
     */
    public function getParameterName(): string
    {
        return $this->parameterName;
    }

    /**
     * @param string $parameterName
     * @return SchemaParameter
     */
    public function setParameterName(string $parameterName): SchemaParameter
    {
        $this->parameterName = $parameterName;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return SchemaParameter
     */
    public function setType(string $type): SchemaParameter
    {
        $this->type = $type;
        return $this;
    }
}