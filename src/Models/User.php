<?php

namespace LifeSpikes\Models;

use Exception;
use Serializable;

class User extends Model implements Serializable
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
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

    public static function findByEmail(string $email): ?User
    {
        return ($row = self::stmt('SELECT * FROM users WHERE email = ?', [$email])->fetch())
            ? new User($row)
            : null;
    }

    public function __serialize(): array
    {
        return get_object_vars($this);
    }

    public function __unserialize(array $data): void
    {
        $this->populateFrom($data);
    }

    public function serialize(): array|string|null
    {
        return $this->__serialize();
    }

    public function unserialize(string $data)
    {
        $this->__unserialize(unserialize($data));
    }
}
