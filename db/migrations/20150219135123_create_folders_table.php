<?php

use Phinx\Migration\AbstractMigration;

class CreateFoldersTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table( 'folders', array(
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ));

        $table->addColumn('name', 'string');
        $table->addColumn('description', 'string');
        $table->addColumn('dir_name', 'string');
        $table->addColumn('menu_link', 'integer');
        $table->addColumn('active', 'integer', ['default' => 1]);
        $table->addColumn('parent_id', 'integer', ['default' => 0]);
        $table->addColumn('layout_id', 'integer', ['default' => 0]);

        // timestamps
        $table->addColumn('created_at', 'datetime', array( 'null' => true ));
        $table->addColumn('updated_at', 'datetime', array( 'null' => true ));
        $table->addColumn('deleted_at', 'datetime', array( 'null' => true ));

        $table->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->dropTable( 'folders' );
    }
}
