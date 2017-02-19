<?php

use Phinx\Migration\AbstractMigration;

class CreateContentTypeFieldsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table( 'content_type_fields', array(
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ));

        $table->addColumn('name', 'string');
        $table->addColumn('data_type', 'string');
        $table->addColumn('field_name', 'string');
        $table->addColumn('content_type_id', 'integer');

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
        $this->dropTable( 'content_type_fields' );
    }
}
