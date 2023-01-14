<?php

namespace Grimzy\LaravelMysqlSpatial\Eloquent;

use Grimzy\LaravelMysqlSpatial\ExpressionGenerator;
use Grimzy\LaravelMysqlSpatial\MysqlConnection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class SpatialExpression extends Expression
{
    protected $geomValue;

    public function __construct($value, ConnectionInterface $connection = null)
    {
        $this->geomValue = $value;
        $expression = ExpressionGenerator::getExpression($connection);
        parent::__construct($expression);
    }

    public function getSpatialValue()
    {
        return $this->geomValue->toWkt();
    }

    public function getSrid()
    {
        return $this->geomValue->getSrid();
    }
}
