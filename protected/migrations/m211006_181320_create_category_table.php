<?php

class m211006_181320_create_category_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('category', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'string NOT NULL',
            'description' => 'string',
        ));
    }
 
    public function down()
    {
        $this->dropTable('category');
    }
}