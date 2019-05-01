<?php

use yii\db\Migration;

/**
 * Class m190429_062345_createActivityFilesTable
 */
class m190429_062345_createActivityFilesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files',[
            'id'=>$this->primaryKey(),
            'filename'=>$this->string(512)->notNull(),
            'activity_id'=>$this->integer()->notNull(),
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
        $this->dropTable('files');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_062345_createActivityFilesTable cannot be reverted.\n";

        return false;
    }
    */
}
