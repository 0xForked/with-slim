<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * Default user data level root
     *
     */
    public function run()
    {
        $user_seed = [
            [
                'phone' => '+62822700000000',
                'email' => 'brandofredrik@gmail.com',
                'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
                'status_acc' => '1'
            ],
            [
                'phone' => '+62822700000001',
                'email' => 'demo_collector@repas.id',
                'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
                'status_acc' => '1'
            ],
        ];
        $user = $this->table('users');
        $user->insert($user_seed)->save();

        $role_seed = [
            [
                'title' => 'admin'
            ],
            [
                'title' => 'collector'
            ]
        ];
        $role = $this->table('roles');
        $role->insert($role_seed)->save();

        $user_has_role_seed = [
            [
                'user_id' => 1,
                'role_id' => 1
            ],
            [
                'user_id' => 2,
                'role_id' => 2
            ]
        ];
        $user_has_role = $this->table('user_has_role');
        $user_has_role->insert($user_has_role_seed)->save();

    }
}
