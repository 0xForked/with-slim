<?php


use Phinx\Migration\AbstractMigration;

class CreateMarketTable extends AbstractMigration
{
    /**
    * Migrate Up.
    */
    public function up()
    {
        $markets = $this->table('markets');
        $markets->addColumn('title', 'string')
            ->addColumn('address', 'text')
            ->addColumn('lat', 'text')
            ->addColumn('lng', 'text')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
