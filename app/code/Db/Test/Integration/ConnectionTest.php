<?php

declare(strict_types=1);

namespace MadeiraMadeira\Test\Integration;

use MadeiraMadeira\Db\Connection;
use PHPUnit\Framework\TestCase;

final class ConnectionTest extends TestCase
{
    /**
     * @var Connection
     */
    private $connection;

    const EMAIL_TEST = 'emailtest@emailtest.com';

    protected function setUp()
    {
        $config = require dirname(__DIR__) . '/../../../config/db.php';
        $dbConfig = $config['db'];

        $pdo = new \PDO($dbConfig['dns'], $dbConfig['username'], $dbConfig['password']);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, TRUE);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection = new Connection($pdo);
    }

    public static function setUpBeforeClass()
    {
        $config = require dirname(__DIR__) . '/../../../config/db.php';
        $dbConfig = $config['db'];

        $pdo = new \PDO($dbConfig['dns'], $dbConfig['username'], $dbConfig['password']);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, TRUE);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $conn = new Connection($pdo);

        $userTest = $pdo->query('SELECT * FROM users WHERE email="' . self::EMAIL_TEST . '"');

        if ($userTest->fetch()['email'] == self::EMAIL_TEST) {
            $conn = $pdo->prepare('DELETE FROM users WHERE email=:email');
            $emailTest = self::EMAIL_TEST;
            $conn->bindParam(':email', $emailTest);
            $conn->execute();
        }

    }

    public function testInsert()
    {
        $conn = $this->connection;

        $userId = $conn->insert('users', [
            'username' => 'usertest',
            'email' => self::EMAIL_TEST,
            'password' => '123455',
            'first_name' => 'Rafael',
            'last_name' => 'Ortega Bueno',
            'created' => date('Y-m-d H:i:s')
        ]);

        $this->assertIsInt($userId);
    }

    /**
     * @depends testInsert
     */
    public function testQuery()
    {
        $conn = $this->connection;
        $pdoStatement = $conn->query('SELECT email FROM users WHERE email = "' . self::EMAIL_TEST . '"');

        $this->assertEquals($pdoStatement->fetch()['email'], self::EMAIL_TEST);
    }

    /**
     * @depends testQuery
     */
    public function testUpdate()
    {
        $conn = $this->connection;
        $user = $conn->query('SELECT id FROM users WHERE email = "' . self::EMAIL_TEST . '"')->fetch();
        $userUpdate = $conn->update('users', [
            'first_name' => 'Robson'
        ], $user['id']);

        $userUpdated = $conn->query('SELECT * FROM users WHERE email = "' . self::EMAIL_TEST . '"')->fetch();

        $this->assertEquals('Robson', $userUpdated['first_name']);
    }

    /**
     * @depends testUpdate
     */
    public function testDelete()
    {
        $conn = $this->connection;
        $id = $conn->query('SELECT id FROM users WHERE email = "' . self::EMAIL_TEST . '"')->fetch()['id'];

        $this->assertTrue($conn->delete('users', $id));
    }
}