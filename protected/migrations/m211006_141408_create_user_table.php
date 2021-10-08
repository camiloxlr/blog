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
            'created_at' => 'timestamp default CURRENT_TIMESTAMP',
            'updated_at' => 'timestamp default CURRENT_TIMESTAMP',
        ));

		$this->insert('user', [
            'name' => 'Tayane C.',
			'email' => 'tayane@gmail.com',
            'password' => 123123,
            'description' => 'Autora de artigos para blogs de tecnologia.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('user', [
            'name' => 'Johnny S.',
			'email' => 'johnny@gmail.com',
            'password' => 123123,
            'description' => 'Leitor de livros de frete e mudanças.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
 
    public function down()
    {
        $this->dropTable('user');
    }
}