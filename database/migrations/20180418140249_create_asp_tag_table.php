<?php


use Phinx\Migration\AbstractMigration;

class CreateAspTagTable extends AbstractMigration
{
    public function up()
    {
        $asp_tag = $this->table('asp_tags');
        $asp_tag->addColumn('_slug', 'string')
                ->addColumn('_title', 'string', ['limit' => 75])
                ->addColumn('_description', 'string')
                ->addColumn('_count_used', 'integer')
                ->save();
    }

    public function down()
    {

    }
}
