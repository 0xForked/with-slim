<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateMerchantBuildingPriceTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $merchant_building_prices = $this->table('merchant_building_prices');
        $merchant_building_prices->addColumn('title', 'string')
            ->addColumn('description', 'text')
            ->addColumn('price', 'integer', ['limit' => MysqlAdapter::INT_MEDIUM, 'null' => false])
            ->addColumn('type_id', 'integer', ['null' => false])
            ->addForeignKey('type_id', 'merchant_types', 'id', ['delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
