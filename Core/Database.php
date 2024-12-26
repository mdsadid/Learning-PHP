<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct(array $config, string $username = 'root', string $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function get(): false|array
    {
        return $this->statement->fetchAll();
    }

    public function firstOrFail()
    {
        $result = $this->first();

        if (!$result) abort();

        return $result;
    }

    public function first()
    {
        return $this->statement->fetch();
    }

    public function insertAndFetch(string $table, array $data)
    {
        $columns      = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(fn($key) => ":$key", array_keys($data)));

        $this->query("INSERT INTO $table ($columns) VALUES ($placeholders)", $data);

        $lastInsertId = $this->connection->lastInsertId();

        return $this->query("SELECT * FROM $table WHERE id = :id", [
            'id' => $lastInsertId
        ])->first();
    }

    public function query(string $query, array $params = []): static
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }
}
