<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $dateStart
 * @property string $dateEnd
 * @property int $useNotification
 * @property string $email
 * @property int $isBlocked
 * @property int $isRepeat
 * @property int $repeatCount
 * @property int $repeatInterval
 * @property string $created_on
 * @property string $updated_on

 * @property int $user_id
 *
 * @property Users $user
 * @property Files[] $files
 */
class ActivityDB extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'dateStart', 'user_id'], 'required'],
            [['description'], 'string'],

            [['dateStart', 'dateEnd', 'created_on','updated_on'], 'safe'],
            [['useNotification', 'isBlocked', 'isRepeat', 'repeatCount', 'repeatInterval', 'user_id'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'dateStart' => Yii::t('app', 'Date Start'),
            'dateEnd' => Yii::t('app', 'Date End'),
            'useNotification' => Yii::t('app', 'Use Notification'),
            'email' => Yii::t('app', 'Email'),
            'isBlocked' => Yii::t('app', 'Is Blocked'),
            'isRepeat' => Yii::t('app', 'Is Repeat'),
            'repeatCount' => Yii::t('app', 'Repeat Count'),
            'repeatInterval' => Yii::t('app', 'Repeat Interval'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['activity_id' => 'id']);
    }
}
