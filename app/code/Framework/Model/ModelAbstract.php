<?php

declare(strict_types=1);

namespace MadeiraMadeira\Framework\Model;

use MadeiraMadeira\Db\Api\ConnectionInterface;
use MadeiraMadeira\Framework\Model\Api\ModelInterface;

/**
 * Class ModelAbstract
 * @package MadeiraMadeira\Framework\Model
 */
abstract class ModelAbstract implements ModelInterface
{
    /**
     * @var ConnectionInterface
     */
    protected $connection;

    /**
     * @var array|null
     */
    protected $fillable = ['*'];

    /**
     * @var array
     */
    private $data = [];

    /**
     * User constructor.
     * @param ConnectionInterface $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Load Data
     *
     * @param int|string $idOrColumnValue
     * @param null|string $column
     * @return $this
     */
    public function load($idOrColumnValue, $column = null) : ModelInterface
    {
        if (is_null($column)) {
            $column = 'id';
        }

        try {
            $modelData = $this->connection
                ->query(
                    'SELECT ' . implode(',', $this->fillable) . ' FROM ' . $this->getTableName()
                    . ' WHERE ' . $column . ' = :value',
                    [
                        ':value' => $idOrColumnValue
                    ]
                );

            $result = $modelData->fetch(\PDO::FETCH_ASSOC);

            $this->setData($result);

            if (! isset($this->data['id'])) {
                $this->data = [];
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        return $this;
    }

    /**
     * @param array|string $dataOrKey
     * @param array $data
     * @return $this
     */
    public function setData($dataOrKey, $data = null) : ModelInterface
    {
        if (! is_null($data)) {
            $this->data[$dataOrKey] = $data;
        } else {
            $this->data = array_merge($this->data, $dataOrKey);
        }

        return $this;
    }

    /**
     * @param bool $key
     * @return mixed
     */
    public function getData($key = false)
    {
        if ($key) {
            return isset($this->data[$key]) ? $this->data[$key] : false;
        }

        return $this->data;
    }

    /**
     * @return $this
     */
    public function save() : ModelInterface
    {
        try {
            if (isset($this->data['id'])) {
                // Update

                if (count($this->getData())) {
                    $id = $this->connection->update(
                        $this->getTableName(),
                        $this->getData()
                    );

                    $this->setData('id', $id);
                }
            } else {
                // New Records
                $id = $this->connection->insert(
                    $this->getTableName(),
                    $this->getData()
                );

                $this->setData('id', $id);
            }

            return $this;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Delete entity
     * @return bool
     */
    public function delete() : bool
    {
        try {
            $this->connection->delete(
                $this->getTableName(),
                $this->getData('id')
            );

            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return false;
    }
}
