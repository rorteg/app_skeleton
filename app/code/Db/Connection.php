<?php

declare(strict_types=1);

namespace MadeiraMadeira\Db;

use MadeiraMadeira\Db\Api\ConnectionInterface;

/**
 * Class Connection
 * @package MadeiraMadeira\Db
 */
class Connection implements ConnectionInterface
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Connection constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Db Query
     *
     * @param string $query
     * @param array $parameters
     * @return \PDOStatement
     */
    public function query($query, $parameters = []): \PDOStatement
    {
        $conn = $this->pdo;

        if (! count($parameters)) {
            $stmt = $conn->query($query);
        } else {
            $stmt = $conn->prepare($query);
            $stmt->execute($parameters);
        }

        return $stmt;
    }

    /**
     * Db Update
     *
     * @param string $table
     * @param array $parameters
     * @return int
     */
    public function update($table, $parameters) : int
    {
        $conn = $this->pdo;

        $pdoFormatParams = $this->getPDOFormatParams($parameters);

        $arrayUpdate = [];

        foreach ($pdoFormatParams[self::KEY_COLUMNS] as $column) {
            if ($column !== 'id') {
                $arrayUpdate[] = $column . ' = :' . $column;
            }
        }

        $updateQuery = $conn->prepare(
            'UPDATE ' . $table
            . ' SET ' . implode(',', $arrayUpdate) . ' WHERE id=:id'
        );

        $updateQuery->execute($pdoFormatParams[self::KEY_VALUES_BIND]);

        return $updateQuery->rowCount();
    }

    /**
     * Db Insert
     *
     * @param string $table
     * @param array $parameters
     * @return int
     */
    public function insert($table, $parameters) : int
    {
        $conn = $this->pdo;

        $pdoFormatParams = $this->getPDOFormatParams($parameters);

        $insertQuery = $conn->prepare(
            'INSERT INTO ' . $table
            . ' (' . implode(',', $pdoFormatParams[self::KEY_COLUMNS]) . ') VALUES ('
            . implode(',', $pdoFormatParams[self::KEY_COLUMNS_KEYS]) . ')'
        );


        $insertQuery->execute($pdoFormatParams[self::KEY_VALUES_BIND]);
        $lastId = $conn->lastInsertId();
        return (int) $lastId;
    }

    /**
     * Db Delete
     *
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function delete($table, $id) : bool
    {
        $conn = $this->pdo;

        try {
            $stmt = $conn->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * Return array for PDO queries
     *
     * @param array $parameters
     * @return array
     */
    private function getPDOFormatParams($parameters) : array
    {
        $columns = [];
        $columnsKeys = [];
        $valuesBind = [];

        foreach ($parameters as $key => $parameter) {
            $columns[] = $key;
            $columnsKeys[] = ':' . $key;
            $valuesBind[':' . $key] = $parameter;
        }

        return [
            self::KEY_COLUMNS => $columns,
            self::KEY_COLUMNS_KEYS => $columnsKeys,
            self::KEY_VALUES_BIND => $valuesBind
        ];
    }
}
