<?php


use Phinx\Seed\AbstractSeed;

class User extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email' => 'john@due.com',
                'password' => password_hash('admin@123', PASSWORD_DEFAULT),
                'first_name' => 'John',
                'last_name' => 'Due'
            ]
        ];

        $this->table('users')->insert($data)->save();
    }
}
