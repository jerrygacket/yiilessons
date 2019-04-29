<?php

use yii\db\Migration;

/**
 * Class m190429_064842_insertData
 */
class m190429_064842_insertData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('users',[
            'id'=>1,
            'email'=>'test@test.ru',
            'password_hash'=>'qwerqwer',
        ]);
        $this->insert('users',[
            'id'=>2,
            'email'=>'test1@test.ru',
            'password_hash'=>'qwerqwer',
        ]);
        $this->batchInsert('activity',[
            'title','dateStart','user_id','useNotification'],[
            ['title 1',date('Y-m-d'),1,0],
            ['title 2',date('Y-m-d'),2,0],
            ['title 3',date('Y-m-d'),2,1],
            ['title 4',date('Y-m-d'),1,1],
            ['title 5','2019-03-01',1,0],
            ['title 6','2019-03-02',2,1],
        ]);

        $this->batchInsert('files',[
            'filename','activity_id'],[
            ['file1.png',1],
            ['file2.jpg',2],
            ['file3.pdf',3],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
        $this->delete('activity');
        $this->delete('files');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190429_064842_insertData cannot be reverted.\n";

        return false;
    }
    */
}
