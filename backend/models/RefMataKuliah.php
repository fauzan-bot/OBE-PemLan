<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "ref_mata_kuliah".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property int|null $sks
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_user
 * @property string|null $updated_user
 *
 * @property MataKuliahTayang[] $mataKuliahTayangs
 * @property RefCpmk[] $refCpmks

 */
class RefMataKuliah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function getDb() {
        $prodi = Yii::$app->user->identity->prodigy->prodi;
        if (Yii::$app->user->identity->prodigy->prodi == 'mesin') {
            return Yii::$app->db;
        }
        return Yii::$app->$prodi;
    }
    
    public static function tableName()
    {
        return 'ref_mata_kuliah';
    }

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama', 'sks',], 'required', 'message' => '{attribute} tidak boleh kosong'],
            [['sks', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['kode'], 'string', 'max' => 16],
            [['nama'], 'string', 'max' => 64],
            [['contoh_soal'], 'string', 'max' => 64],
            [['rps'], 'string', 'max' => 64],
            [['presensi'], 'string', 'max' => 64],
            [['nilai'], 'string', 'max' => 64],
            [['kueisioner'], 'string', 'max' => 64],
            [['evaluasi'], 'string', 'max' => 64],
            [['kinerja'], 'string', 'max' => 64],
            [['created_user', 'updated_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'sks' => 'Sks',
            'contoh_soal' => 'Contoh Soal',
            'rps' => 'RPS',
            'presensi' => 'Presensi',
            'nilai' => 'Nilai',
            'evaluasi' => 'Evaluasi',
            'kinerja' => 'Kinerja',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_user' => 'Created User',
            'updated_user' => 'Updated User',
        ];
    }

    /**
     * Gets query for [[MataKuliahTayangs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMataKuliahTayangs()
    {
        return $this->hasMany(MataKuliahTayang::className(), ['id_ref_mata_kuliah' => 'id']);
    }

    /**
     * Gets query for [[RefCpmks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefCpmks()
    {
        return $this->hasMany(RefCpmk::className(), ['id_ref_mata_kuliah' => 'id']);
    }

    
}
