<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Model;

use MadeiraMadeira\Framework\Api\Data\ModelInterface;
use MadeiraMadeira\Framework\Model\ModelAbstract;
use MadeiraMadeira\User\Api\Data\UserInterface;

/**
 * Class User
 * @package MadeiraMadeira\User\Model
 */
class User extends ModelAbstract implements UserInterface
{
    /**
     * @var string|bool
     */
    private $salt = false;

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
     */
    public function setPassword($password): ModelInterface
    {
        $this->setData(self::PASSWORD, md5($this->getSalt() . $password));
        $this->setPasswordSalt($this->getSalt());
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
     * @param string $passwordSalt
     * @return $this
     */
    private function setPasswordSalt($passwordSalt): ModelInterface
    {
        $this->setData(self::PASSWORD_SALT, $passwordSalt);
        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordSalt(): string
    {
        return $this->getData(self::PASSWORD_SALT);
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
     * @return string
     */
    private function getSalt()
    {
        $salt = $this->salt;

        if (! $this->salt) {
            $salt = uniqid((string)mt_rand(), true);
            $this->salt = $salt;
        }

        return $salt;
    }
}