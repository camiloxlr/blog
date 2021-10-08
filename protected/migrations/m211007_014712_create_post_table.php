<?php

class m211007_014712_create_post_table extends CDbMigration
{
	public function up()
    {
        $this->createTable('post', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'string',
            'content' => 'text',
            'is_published' => 'tinyint NOT NULL DEFAULT 0',
            'reading_time' => 'int',
            'published_at' => 'timestamp',
            'category_id' => 'int(11) NOT NULL',
            'user_id' => 'int(11) NOT NULL',
            'created_at' => 'timestamp default CURRENT_TIMESTAMP',
            'updated_at' => 'timestamp default CURRENT_TIMESTAMP',
        ));

		$this->addForeignKey("category_id", "post", "category_id", "category", "id", "CASCADE", "RESTRICT");
		$this->addForeignKey("user_id", "post", "user_id", "user", "id", "CASCADE", "RESTRICT");

		$this->insert('post', [
            'id' => 1,
            'title' => 'Nova integração com o banco Inter!',
			'content' => 'A mais recente novidade da conexa é a integração com o banco inter...',
            'is_published' => 1,
            'reading_time' => 3,
            'published_at' => date('Y-m-d H:i:s'),
            'category_id' => 1,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('post', [
            'id' => 2,
            'title' => 'Nova integração com a pagar.me!',
			'content' => 'A mais recente novidade da conexa é a integração com a pagar.me...',
            'is_published' => 1,
            'reading_time' => 2,
            'published_at' => date('Y-m-d H:i:s'),
            'category_id' => 1,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

		$this->insert('post', [
            'id' => 3,
            'title' => 'Novo extrato de recorrências do Financeiro!',
			'content' => 'A mais recente novidade da conexa é o novo extrato de recorrências do financeiro...',
            'is_published' => 1,
            'reading_time' => 5,
            'published_at' => date('Y-m-d H:i:s'),
            'category_id' => 3,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
 
    public function down()
    {
		$this->delete('post', ['id' => 3]);
		$this->delete('post', ['id' => 2]);
		$this->delete('post', ['id' => 1]);
        $this->dropTable('post');
    }
}