<?php

use yii\db\Migration;

/**
 * Class m190506_103225_extendActionsTable01
 */
class m190506_103225_extendActionsTable01 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('activity','dateEnd',
            $this->date()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('activity','dateEnd');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190506_103225_extendActionsTable01 cannot be reverted.\n";

        return false;
    }
    */
}
