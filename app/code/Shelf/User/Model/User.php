<?php

declare(strict_types=1);

namespace Shelf\User\Model;

use Shelf\Framework\Model\Api\ModelInterface;
use Shelf\Framework\Model\ModelAbstract;
use Shelf\User\Api\Data\UserInterface;

/**
 * Class User
 * @package Shelf\User\Model
 */
class User extends ModelAbstract implements UserInterface
{
    /**
     * @var bool
     */
    private $isPasswordEncrypt = false;

    /**
     * Get Db table name
     *
     * @return string
     */
    public function getTableName() : string
    {
        return 'users';
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username): ModelInterface
    {
        $this->setData(self::USERNAME, $username);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getData(self::USERNAME);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email): ModelInterface
    {
        $this->setData(self::EMAIL, $email);
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @param string $password
     * @return $this
     * @throws \Exception
     */
    public function setPassword($password): ModelInterface
    {
        $this->setData(self::PASSWORD, password_hash($password, PASSWORD_DEFAULT));
        $this->isPasswordEncrypt = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getData(self::PASSWORD);
    }

    /**
     * @param $firstName
     * @return $this
     */
    public function setFirstName($firstName): ModelInterface
    {
        $this->setData(self::FIRST_NAME, $firstName);
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @param $lastName
     * @return $this
     */
    public function setLastName($lastName): ModelInterface
    {
        $this->setData(self::LAST_NAME, $lastName);
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getData(self::LAST_NAME);
    }

    /**
     * @param string $created
     * @return $this
     */
    public function setCreated($created): ModelInterface
    {
        $this->setData(self::CREATED, $created);
        return $this;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->getData(self::CREATED);
    }

    /**
     * @param string $updated
     * @return $this
     */
    public function setUpdated($updated): ModelInterface
    {
        $this->setData(self::UPDATED, $updated);
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdate(): string
    {
        return $this->getData(self::UPDATED);
    }

    /**
     * @return int|string|bool
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function save(): ModelInterface
    {
        $passwordInfo = password_get_info($this->getData(self::PASSWORD));
        if (! $this->isPasswordEncrypt
            && $this->getData(self::PASSWORD)
            && $passwordInfo['algo'] == 0) {
            $this->setPassword($this->getData(self::PASSWORD));
        }

        return parent::save();
    }
}
