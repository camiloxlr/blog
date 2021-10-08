<?php

class m211007_195051_create_comment_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('comment', array(
            'id' => 'int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'content' => 'text',
            'post_id' => 'int(11) NOT NULL',
            'comment_user_id' => 'int(11) NOT NULL',
            'created_at' => 'timestamp default CURRENT_TIMESTAMP',
            'updated_at' => 'timestamp default CURRENT_TIMESTAMP',
        ));

		$this->addForeignKey("post_id", "comment", "post_id", "post", "id", "CASCADE", "RESTRICT");
		$this->addForeignKey("comment_user_id", "comment", "comment_user_id", "user", "id", "CASCADE", "RESTRICT");
	
		$this->insert('comment', [
            'id' => 1,
			'content' => 'Este artigo ficou top!',
            'post_id' => 1,
            'comment_user_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
	}

	public function down()
	{
		$this->delete('comment', ['id' => 1]);
		$this->dropTable('comment');
	}

}