<?php

declare(strict_types=1);

namespace Shelf\Db\Api;

/**
 * Interface ConnectionInterface
 * @package Shelf\Db\Api
 */
interface ConnectionInterface
{
    const KEY_COLUMNS = 'columns';
    const KEY_COLUMNS_KEYS = 'columns_keys';
    const KEY_VALUES_BIND = 'values_bind';

    /**
     * Db Query
     *
     * @param string $query
     * @param array $parameters
     * @return \PDOStatement
     */
    public function query($query, $parameters) : \PDOStatement;

    /**
     * Db Update
     *
     * @param string $table
     * @param array $parameters
     * @return int
     */
    public function update($table, $parameters) : int;

    /**
     * Db Insert
     *
     * @param string $table
     * @param array $parameters
     * @return int
     */
    public function insert($table, $parameters) : int;

    /**
     * Db Delete
     *
     * @param string $table
     * @param int $id
     * @return bool
     */
    public function delete($table, $id) : bool;
}
