<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employe_status}}`.
 */
class m210217_153422_create_employe_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employe_status}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull(),
            'updated' => $this->integer(),
            'created' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employe_status}}');
    }
}
