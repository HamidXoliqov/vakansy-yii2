<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employe_history}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%employe}}`
 */
class m210219_094825_create_employe_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employe_history}}', [
            'id' => $this->primaryKey(),
            'employe_id' => $this->integer(),
            'employe_status_id' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'diadline_time' => $this->integer(),
            'user_id' => $this->integer(),
            'create_at' => $this->integer(),
        ]);

        // creates index for column `employe_id`
        $this->createIndex(
            '{{%idx-employe_history-employe_id}}',
            '{{%employe_history}}',
            'employe_id'
        );

        // add foreign key for table `{{%employe}}`
        $this->addForeignKey(
            '{{%fk-employe_history-employe_id}}',
            '{{%employe_history}}',
            'employe_id',
            '{{%employe}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%employe}}`
        $this->dropForeignKey(
            '{{%fk-employe_history-employe_id}}',
            '{{%employe_history}}'
        );

        // drops index for column `employe_id`
        $this->dropIndex(
            '{{%idx-employe_history-employe_id}}',
            '{{%employe_history}}'
        );

        $this->dropTable('{{%employe_history}}');
    }
}
