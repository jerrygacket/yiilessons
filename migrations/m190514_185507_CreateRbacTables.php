<?php

use yii\db\Migration;

/**
 * Class m190514_185507_CreateRbacTables
 */
class m190514_185507_CreateRbacTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $componentRbac = Yii::createObject(array(
            'class' => \app\components\RbacComponent::class,
        ));
        $componentRbac->generateRbac();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $componentRbac = Yii::createObject(array(
            'class' => \app\components\RbacComponent::class,
        ));
        $componentRbac->cleanRbac();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190514_185507_CreateRbacTables cannot be reverted.\n";

        return false;
    }
    */
}
