<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $name
 * @property int $code
 * @property string $date_of_birth
 * @property string $join_date
 * @property string $expired_date
 * @property string $type
 * @property int $gender
 * @property string $address
 * @property string $phone
 * @property string $photo
 * @property string $email
 * @property string $password
 * @property int $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 */
class Member extends \app\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'date_of_birth', 'join_date', 'expired_date', 'type', 'gender', 'address', 'phone', 'email', 'password', 'status'], 'required'],
            [['code', 'gender', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date_of_birth', 'join_date', 'expired_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'type', 'address', 'phone', 'email', 'password'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'code' => 'Kode',
            'date_of_birth' => 'Tanggal Lahir',
            'join_date' => 'Join Date',
            'expired_date' => 'Expired Date',
            'type' => 'Tipe',
            'gender' => 'Jenis Kelamin',
            'address' => 'Alamat',
            'phone' => 'Nomor Telephone',
            'photo' => 'Photo',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function listType () {
        return[
            1 => "siswa",
            2 => "guru",
            3 => "karyawan",
            4 => "orang luar"
        ];
    }

    public static function listGender () {
        return[
            1 => "Laki-laki",
            2 => "Perempuan"
        ];
    }

    public static function listStatus () {
        return[
            1 => "Aktif",
            2 => "Tidak Aktif"
        ];
    }
}
