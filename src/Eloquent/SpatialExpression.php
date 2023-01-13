<?php

namespace Grimzy\LaravelMysqlSpatial\Eloquent;

use Grimzy\LaravelMysqlSpatial\ExpressionGenerator;
use Grimzy\LaravelMysqlSpatial\MysqlConnection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class SpatialExpression extends Expression
{
    protected ?ConnectionInterface $connection;

    public function __construct($value, ConnectionInterface $connection = null)
    {
        parent::__construct($value);
        $this->connection = $connection;
    }

    public function getValue()
    {
        return ExpressionGenerator::getExpression($this->connection);
    }

    public function getSpatialValue()
    {
        return $this->value->toWkt();
    }

    public function getSrid()
    {
        return $this->value->getSrid();
    }
}
