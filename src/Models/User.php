<?php

namespace LifeSpikes\Models;

use Exception;

class User extends Model
{
    public int $id;
    public string $name;
    public string $email;
    public string $picture;

    public function __construct(public array $attrs = [])
    {
        $this->populateFrom($attrs);
    }

    public static function all(): array
    {
        return array_map(function ($row) {
            return new User($row);
        }, self::stmt('SELECT * FROM users')->fetchAll());
    }

    public static function find(int $id): ?User
    {
        return ($row = self::stmt('SELECT * FROM users WHERE id = ?', [$id])->fetch())
            ? new User($row)
            : null;
    }

    public static function create(array $payload): User
    {
        return self::find(
            self::insert('users', $payload)
        );
    }
}
