<?php

declare(strict_types=1);

namespace MadeiraMadeira\User\Test\Model;

use MadeiraMadeira\Db\Connection;
use MadeiraMadeira\User\Api\Data\UserInterface;
use MadeiraMadeira\User\Model\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package MadeiraMadeira\User\Test\Model
 */
final class UserTest extends TestCase
{
    /**
     * @var UserInterface
     */
    private $userModel;

    protected function setUp()
    {
        $connection = $this->createMock(Connection::class);
        $this->userModel = new User($connection);
    }

    public function testUserUsername()
    {
        $user = $this->userModel;
        $username = 'testusername';
        $user->setUsername($username);

        $this->assertEquals($username, $user->getUsername());
    }
}
