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
                'unique_id' => 'adXbw3jensZlsSur0fYkTIfpDPrvLgDK',
                'username' => 'aasumitro',
                'phone' => '+6282271115593',
                'email' => 'aasumitro@gmail.com',
                'password' => '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36',
                'status_acc' => '1'
            ],
        ];

        $user = $this->table('users');
        $user->insert($user_seed)
             ->save();

    }
}
