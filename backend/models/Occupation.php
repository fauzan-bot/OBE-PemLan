<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "occupation".
 *
 * @property int $id
 * @property string $occupation
 *
 * @property UserOccupationProdi[] $userOccupationProdis
 */
class Occupation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'occupation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['occupation'], 'required'],
            [['occupation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'occupation' => 'Occupation',
        ];
    }

    /**
     * Gets query for [[UserOccupationProdis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserOccupationProdis()
    {
        return $this->hasMany(UserOccupationProdi::className(), ['occupation_id' => 'id']);
    }
}
