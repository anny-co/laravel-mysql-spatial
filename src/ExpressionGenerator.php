<?php

namespace Grimzy\LaravelMysqlSpatial;

use Illuminate\Database\ConnectionInterface;

class ExpressionGenerator
{

    public static function getExpression(ConnectionInterface $connection): string
    {
        if(($connection instanceof \Illuminate\Database\MySqlConnection) && $connection->isMaria()) {
            return "ST_GeomFromText(?, ?)";
        }

        return "ST_GeomFromText(?, ?, 'axis-order=long-lat')";
    }
}