<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employe}}`.
 */
class m210217_153348_create_employe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employe}}', [
            'id' => $this->primaryKey(),
            'lastname'=> $this->string()->notNull(),
            'firstname'=> $this->string(),
            'address'=> $this->string(),
            'country_of_origin'=> $this->string(),
            'email'=> $this->string()->notNull(),
            'phone_number'=> $this->string()->notNull(),
            'age' => $this->integer()->notNull(),
            'hired' => $this->boolean(),
            'employe_status_id' => $this->integer(),
            'user_id' => $this->integer(),
            'updated' => $this->integer(),
            'created' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employe}}');
    }
}
