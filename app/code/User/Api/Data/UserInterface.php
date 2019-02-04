<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Api\Data;

use MadeiraMadeira\Framework\Api\Data\ModelInterface;

/**
 * Interface UserInterface
 * @package MadeiraMadeira\User\Api\Data
 */
interface UserInterface extends ModelInterface
{
    /**
     * Columns Keys
     */
    const USERNAME = 'username';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    const PASSWORD_SALT = 'password_salt';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const CREATED = 'created';
    const UPDATED = 'updated';

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username) : ModelInterface;

    /**
     * @return string
     */
    public function getUsername() : string;

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email) : ModelInterface;

    /**
     * @return string
     */
    public function getEmail() : string;

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password) : ModelInterface;

    /**
     * @return string
     */
    public function getPassword() : string;

    /**
     * @return string
     */
    public function getPasswordSalt() : string;

    /**
     * @param $firstName
     * @return $this
     */
    public function setFirstName($firstName) : ModelInterface;

    /**
     * @return string
     */
    public function getFirstName() : string;

    /**
     * @param $lastName
     * @return $this
     */
    public function setLastName($lastName) : ModelInterface;

    /**
     * @return string
     */
    public function getLastName() : string;

    /**
     * @param string $created
     * @return $this
     */
    public function setCreated($created) : ModelInterface;

    /**
     * @return string
     */
    public function getCreated() : string;

    /**
     * @param string $updated
     * @return $this
     */
    public function setUpdated($updated) : ModelInterface;

    /**
     * @return string
     */
    public function getUpdate() : string;

}
