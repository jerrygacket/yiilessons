<?php

use yii\db\Migration;

/**
 * Class m190429_064237_createActivityFilesFK
 */
class m190429_064237_createActivityFilesFK extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('files_activityIdFK',
            'files','activity_id','activity','id',
            'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('files_activityIdFK','files');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_064237_createActivityFilesFK cannot be reverted.\n";

        return false;
    }
    */
}
