<?php

namespace LifeSpikes\Models;

use \PDO;

class Model
{
    static Model $_instance;

    protected function getConnection(): PDO
    {
        $db = config('db');

        $dsn = sprintf('mysql:host=%s;dbname=%s', $db['host'], $db['database']);

        return new PDO($dsn, $db['user'], $db['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    protected static function stmt(string $sql, array $params = []): bool|\PDOStatement
    {
        ($stmt = self::instance()->getConnection()->prepare($sql))
            ->execute($params);

        return $stmt;
    }

    protected function populateFrom(array $attrs): void
    {
        foreach ($attrs as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    protected static function insert(string $table, array $values): string|false
    {
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(', ', array_keys($values)),
            implode(', ', array_fill(0, count($values), '?'))
        );

        ($conn = self::instance()->getConnection())->prepare($sql)
            ->execute(array_values($values));

        return $conn->lastInsertId();
    }

    private static function instance(): static
    {
        return static::$_instance ?? new static();
    }
}
