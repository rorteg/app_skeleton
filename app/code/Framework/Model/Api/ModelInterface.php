<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Model\Api;

/**
 * Interface ModelInterface
 * @package MadeiraMadeira\Framework\Model\Api
 */
interface ModelInterface
{
    /**
     * Load Data
     *
     * @param int|string $idOrColumnValue
     * @param null|string $column
     * @return $this
     */
    public function load($idOrColumnValue, $column = null) : ModelInterface;

    /**
     * @param array|string $dataOrKey
     * @param array $data
     * @return $this
     */
    public function setData($dataOrKey, $data = null) : ModelInterface;

    /**
     * @param bool $key
     * @return mixed
     */
    public function getData($key = false);

    /**
     * Get Db table name
     *
     * @return string
     */
    public function getTableName() : string;

    /**
     * @return $this
     */
    public function save() : ModelInterface;
}
