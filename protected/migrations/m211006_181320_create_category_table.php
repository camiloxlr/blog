<?php

class m211006_181320_create_category_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('category', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'string NOT NULL',
            'description' => 'string',
            'created_at' => 'timestamp',
        ));

		$this->insert('category', [
            'name' => 'Integracoes',
            'description' => 'Posts sobre integracoes',
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('category', [
            'name' => 'Servicos',
            'description' => 'Posts sobre servicos',
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('category', [
            'name' => 'Financeiro',
            'description' => 'Posts sobre financeiro',
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('category', [
            'name' => 'Agenda',
            'description' => 'Posts sobre agenda',
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('category', [
            'name' => 'Parceiros',
            'description' => 'Posts sobre parceiros',
            'created_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('category', [
            'name' => 'Outros',
            'description' => 'Posts sobre assuntos diversos',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
 
    public function down()
    {
        $this->dropTable('category');
    }
}