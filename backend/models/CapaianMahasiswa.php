<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use backend\models\RefMataKuliah;

/**
 * This is the model class for table "capaian_mahasiswa".
 *
 * @property int $id
 * @property int|null $id_ref_cpmk
 * @property int|null $id_ref_mahasiswa
 * @property float|null $nilai
 * @property string|null $kelas
 * @property string|null $tahun
 * @property string|null $semester ganjil, genap
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $created_user
 * @property string|null $updated_user
 *
 * @property RefCpmk $refCpmk
 * @property RefMahasiswa $refMahasiswa
 */
class CapaianMahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    // $prodi = Yii::$app->user->prodi;
    public static function getDb()
    {
        $prodi = Yii::$app->user->identity->prodigy->prodi;
        if (Yii::$app->user->identity->prodigy->prodi == 'mesin') {
            return Yii::$app->db;
        }
        return Yii::$app->$prodi;
    }

    public static function tableName()
    {
        return 'capaian_mahasiswa';
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
            [['id_ref_cpmk', 'id_ref_mahasiswa', 'status'], 'integer'],
            [['nilai'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['kelas', 'tahun', 'semester'], 'string', 'max' => 16],
            [['created_user', 'updated_user'], 'string', 'max' => 255],
            [['id_ref_cpmk'], 'exist', 'skipOnError' => true, 'targetClass' => RefCpmk::className(), 'targetAttribute' => ['id_ref_cpmk' => 'id']],
            [['id_ref_mahasiswa'], 'exist', 'skipOnError' => true, 'targetClass' => RefMahasiswa::className(), 'targetAttribute' => ['id_ref_mahasiswa' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ref_cpmk' => 'Cpmk',
            'id_ref_mahasiswa' => 'Mahasiswa',
            'nilai' => '',
            'kelas' => 'Kelas',
            'tahun' => 'Tahun',
            'semester' => 'Semester',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_user' => 'Created User',
            'updated_user' => 'Updated User',
        ];
    }

    /**
     * Gets query for [[RefCpmk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefCpmk()
    {
        return $this->hasOne(RefCpmk::className(), ['id' => 'id_ref_cpmk']);
    }

    /**
     * Gets query for [[RefMahasiswa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefMahasiswa()
    {
        return $this->hasOne(RefMahasiswa::className(), ['id' => 'id_ref_mahasiswa']);
    }

    public function getRelasiCpmkCpls()
    {
        return $this->hasMany(RelasiCpmkCpl::className(), ['id_ref_cpmk' => 'id'])
            ->viaTable(RefCpmk::tableName(), ['id' => 'id_ref_cpmk']);
    }

    public function getMataKuliahTayang()
    {
        return $this->hasOne(MataKuliahTayang::className(), ['id_ref_mata_kuliah' => 'id_ref_mata_kuliah'])
            ->viaTable(RefCpmk::tableName(), ['id' => 'id_ref_cpmk']);
    }

    public function getMataKuliah()
    {
        return $this->hasOne(RefMataKuliah::className(), ['id' => 'id_ref_mata_kuliah'])
            ->via('mataKuliahTayang');
    }

    public function getDosen()
    {
        return $this->hasOne(RefDosen::className(), ['id' => 'id_ref_dosen'])
            ->via('mataKuliahTayang');
    }
}
