<?php


use Phinx\Migration\AbstractMigration;

class CreateAspCategoryTable extends AbstractMigration
{

    public function up()
    {
        $asp_category = $this->table('asp_categories');
        $asp_category->addColumn('_slug', 'string')
                    ->addColumn('_title', 'string', ['limit' => 75])
                    ->addColumn('_description', 'string')
                    ->addColumn('_count_used', 'integer')
                    ->save();
    }

    public function down()
    {

    }

}
