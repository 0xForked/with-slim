<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateMerchantBuildingTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $merchant_buildings = $this->table('merchant_buildings');
        $merchant_buildings->addColumn('register_number', 'integer', ['limit' => 50, 'null' => false])
            ->addColumn('name', 'string')
            ->addColumn('description', 'text')
            ->addColumn('widht', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => false]) // in meter
            ->addColumn('length', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'null' => false]) // in meter
            ->addColumn('price_id', 'integer', ['null' => true])
            ->addColumn('market_id', 'integer', ['null' => true])
            ->addForeignKey('price_id', 'merchant_building_prices', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->addForeignKey('market_id', 'markets', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
