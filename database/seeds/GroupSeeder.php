<?php


use Phinx\Seed\AbstractSeed;

class GroupSeeder extends AbstractSeed
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
                'name' => 'root',
                'description' => 'Super level administrator'
            ],
            [
                'name' => 'member',
                'description' => 'Limited access users'
            ]
        ];

        $group = $this->table('groups');
        $group->insert($data)
              ->save();
    }
}
