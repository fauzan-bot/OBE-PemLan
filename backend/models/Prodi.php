<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property int $id
 * @property string $prodi
 *
 * @property UserOccupationProdi[] $userOccupationProdis
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prodi'], 'required'],
            [['prodi'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prodi' => 'Prodi',
        ];
    }

    /**
     * Gets query for [[UserOccupationProdis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOccupationProdis()
    {
        return $this->hasMany(UserOccupationProdi::className(), ['prodi_id' => 'id']);
    }
}
