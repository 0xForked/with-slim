<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateOwnerHasBuildingTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $owner_has_building = $this->table('owner_has_building');
        $owner_has_building
                ->addColumn('owner_id','integer',['null' => true])
                ->addColumn('building_id','integer',['null' => true])
                ->addForeignKey(
                    'owner_id',
                    'merchant_owners',
                    'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->addForeignKey(
                    'building_id',
                    'merchant_buildings',
                    'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
                ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
