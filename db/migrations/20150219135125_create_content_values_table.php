<?php

use Phinx\Migration\AbstractMigration;

class CreateContentValuesTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table( 'content_values', array(
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ));

        $table->addColumn('field_name', 'string');
        $table->addColumn('value', 'string');
        $table->addColumn('content_id', 'integer');

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
        $this->dropTable( 'content_values' );
    }
}
