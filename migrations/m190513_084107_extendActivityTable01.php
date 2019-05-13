<?php

use yii\db\Migration;

/**
 * Class m190513_084107_extendActivityTable01
 */
class m190513_084107_extendActivityTable01 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','updated_on',
            $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity','updated_on');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190513_084107_extendActivityTable01 cannot be reverted.\n";

        return false;
    }
    */
}
