<?php

namespace Grimzy\LaravelMysqlSpatial\Eloquent;

use Grimzy\LaravelMysqlSpatial\MysqlConnection;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class SpatialExpression extends Expression
{
    protected bool $isMaria;

    public function __construct($value, bool $isMaria = false)
    {
        parent::__construct($value);
        $this->isMaria = $isMaria;
    }

    public function getValue()
    {
        if($this->isMaria) {
            return "ST_GeomFromText(?, ?)";
        }

        return "ST_GeomFromText(?, ?, 'axis-order=long-lat')";
    }

    public function getSpatialValue()
    {
        return $this->value->toWkt();
    }

    public function getSrid()
    {
        return $this->value->getSrid();
    }

    public static function makeFromConnection(\Illuminate\Database\ConnectionInterface $connection, $value)
    {
        if(($connection instanceof MysqlConnection
                || $connection instanceof \Illuminate\Database\MySqlConnection)
            && $connection->isMaria()) {

            return new self($value, true);
        }

        return new self($value, false);
    }
}
