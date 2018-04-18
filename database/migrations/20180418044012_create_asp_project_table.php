<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateAspProjectTable extends AbstractMigration
{
    public function up()
    {
        $asp_project = $this->table('asp_project');
        $asp_project->addColumn('_author_id', 'string', ['limit' => 75])
                    ->addColumn('_slug', 'string', ['limit' => 75])
                    ->addColumn('_category', 'string', ['limit' => 75])
                    ->addColumn('_tags', 'string', ['limit' => 75])
                    ->addColumn('_title', 'string', ['limit' => 75])
                    ->addColumn('_description', 'string')
                    ->addColumn('_headline', 'integer', ['limit' => MysqlAdapter::INT_TINY])
                    ->addColumn('_published', 'integer', ['limit' => MysqlAdapter::INT_TINY])
                    ->addColumn('_link_android', 'string', ['limit' => 100])
                    ->addColumn('_link_ios', 'string', ['limit' => 100])
                    ->addColumn('_link_web', 'string', ['limit' => 100])
                    ->addColumn('_link_demo', 'string', ['limit' => 100])
                    ->addColumn('_link_github', 'string', ['limit' => 100])
                    ->addColumn('_link_guide', 'string', ['limit' => 100])
                    ->addColumn('_logo', 'string', ['limit' => 50])
                    ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => true])
                    ->save();
    }

    public function down()
    {

    }
}
