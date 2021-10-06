<?php

class m211006_141408_create_user_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('user', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'string NOT NULL',
            'email' => 'string NOT NULL',
            'password' => 'string NOT NULL',
            'description' => 'string',
            'created_at' => 'timestamp',
        ));
    }
 
    public function down()
    {
        $this->dropTable('user');
    }
}