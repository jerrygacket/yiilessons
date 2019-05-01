<?php

use yii\db\Migration;

/**
 * Class m190429_061508_createActivityTable
 */
class m190429_061508_createActivityTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'description'=>$this->text(),
            'dateStart'=>$this->date()->notNull(),
            'useNotification'=>$this->tinyInteger()->notNull()->defaultValue(0),
            'email'=>$this->string(150),
            'isBlocked'=>$this->tinyInteger()->notNull()->defaultValue(0),
            'isRepeat'=>$this->tinyInteger()->notNull()->defaultValue(0),
            'repeatCount'=>$this->integer()->notNull()->defaultValue(0),
            'repeatInterval'=>$this->integer()->notNull()->defaultValue(0),
            'created_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP')
        ]);
        $this->execute('');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_061508_createActivityTable cannot be reverted.\n";

        return false;
    }
    */
}
