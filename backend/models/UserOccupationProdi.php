<?php

namespace app\models;

use Yii;
use app\models\Prodi;
use common\models\User;
use app\models\Occupation;

/**
 * This is the model class for table "user_occupation_prodi".
 *
 * @property int $id
 * @property int $user_id
 * @property int $prodi_id
 * @property int $occupation_id
 *
 * @property Occupation $occupation
 * @property Prodi $prodi
 * @property User $user
 */
class UserOccupationProdi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_occupation_prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'prodi_id', 'occupation_id'], 'required'],
            [['user_id', 'prodi_id', 'occupation_id'], 'integer'],
            [['occupation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Occupation::className(), 'targetAttribute' => ['occupation_id' => 'id']],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'prodi_id' => 'Prodi ID',
            'occupation_id' => 'Occupation ID',
        ];
    }

    /**
     * Gets query for [[Occupation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOccupation()
    {
        return $this->hasOne(Occupation::className(), ['id' => 'occupation_id']);
    }

    /**
     * Gets query for [[Prodi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(Prodi::className(), ['id' => 'prodi_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'id']);
    }

    public function getJabatan()
    {
        return $this->hasOne(Occupation::className(), ['id' => 'occupation_id']);
    }

    public function getProdit()
    {
        return $this->hasOne(Prodi::className(), ['id' => 'prodi_id']);
    }
}
