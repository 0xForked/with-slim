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

        $user_detail_seed = [
            [
                'uuid' => 'adXbw3jensZlsSur0fYkTIfpDPrvLgDK',
                'ugid' => 1,
                'full_name' => 'Agus Adhi Sumitro'
            ],
        ];

        $user_token_seed = [
            [
                'uuid' => 'adXbw3jensZlsSur0fYkTIfpDPrvLgDK',
                'unique_token' => 'L2nGqCsjjLzXRWJ9gq6Fxesnlb2xjYQ0TiKoDUifi8W0Rkl3L6MJh6YX2UN5yk8f',
                'token_created' => time(),
                'token_expired' => '30'
            ],
        ];


        $user = $this->table('users');
        $user->insert($user_seed)
             ->save();

        $user_detail = $this->table('users_details');
        $user_detail->insert($user_detail_seed)
                    ->save();

        $user_token = $this->table('users_token');
        $user_token->insert($user_token_seed)
                    ->save();
    }
}
