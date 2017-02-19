<?php

use Phinx\Migration\AbstractMigration;

class CreateContentsTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table( 'contents', array(
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ));

        $table->addColumn('name', 'string');
        $table->addColumn('description', 'string');
        $table->addColumn('folder_id', 'integer');
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
        $this->dropTable( 'contents' );
    }
}
