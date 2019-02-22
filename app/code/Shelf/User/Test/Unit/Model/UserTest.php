<?php

declare(strict_types=1);

namespace Shelf\User\Test\Model;

use Shelf\Db\Connection;
use Shelf\User\Api\Data\UserInterface;
use Shelf\User\Model\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package Shelf\User\Test\Model
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

    public function testPassword()
    {
        $user = $this->userModel;
        $user->setPassword('test123');
        $passwordInfo = password_get_info($user->getPassword());

        $this->assertEquals(1, $passwordInfo['algo']);
    }
}
