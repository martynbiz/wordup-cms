<?php

use Phinx\Migration\AbstractMigration;

class CreateLayoutsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table( 'layouts', array(
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ));

        $table->addColumn('name', 'string');
        $table->addColumn('description', 'string');
        $table->addColumn('template', 'text');

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
        $this->dropTable( 'layouts' );
    }
}
