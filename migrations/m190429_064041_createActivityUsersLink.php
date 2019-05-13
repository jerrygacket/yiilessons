<?php

use yii\db\Migration;

/**
 * Class m190429_064041_createActivityUsersLink
 */
class m190429_064041_createActivityUsersLink extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','user_id',
            $this->integer()->notNull());
        $this->addForeignKey('activity_userIdFK',
            'activity','user_id','users','id',
            'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('activity_userIdFK','activity');
        $this->dropColumn('activity','user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_064041_createActivityUsersLink cannot be reverted.\n";

        return false;
    }
    */
}
