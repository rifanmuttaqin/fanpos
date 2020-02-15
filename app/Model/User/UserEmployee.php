<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class UserEmployee extends Model
{
    // use HasRoles;
    protected $table = 'tbl_user_employee';
    protected $guard_name = 'web';

    const JENIS_KELAMIN_LAKI_LAKI = 10;
    const JENIS_KELAMIN_PEREMPUAN = 20;

    const AGAMA_ISLAM       = 10;
    const AGAMA_KRISTEN     = 20;
    const AGAMA_BUDHA       = 30;
    const AGAMA_KONGHUCU    = 40;
    const AGAMA_KATOLIK     = 50;

    const STATUS_BELUM_MENIKAH  = 10;
    const STATUS_MENIKAH        = 20;

    const TIPE_KARYAWAN_TETAP   = 10;
    const TIPE_KARYAWAN_KONTRAK = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','nik', 'jenis_kelamin','tempat_lahir','tanggal_lahir','agama','status_pernikahan','phone','tanggal_masuk','tipe_karyawan','keterangan'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'jenis_kelamin' => self::JENIS_KELAMIN_LAKI_LAKI,
        'agama' => self::AGAMA_ISLAM,
        'status_pernikahan' => self::STATUS_BELUM_MENIKAH,
        'tipe_karyawan' => self::TIPE_KARYAWAN_TETAP,
    ];

    public static $rules = [
        'user_id' => 'integer | unique',
        'nik' => 'string',
        'jenis_kelamin' => 'string',
        'tempat_lahir' => 'required | string',
        'tanggal_lahir' => 'required | integer',
        'agama' => 'required | integer',
        'status_pernikahan' => 'required | integer',
        'phone' => 'required | integer',
        'tanggal_masuk' => 'required | date',
        'tipe_karyawan' => 'required | integer',
        'keterangan' => 'nullable | string',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * 
     */
    public static function getKelaminMeaning($jenis)
    {
        switch ($jenis) {
            case static::JENIS_KELAMIN_LAKI_LAKI:
               return 'Laki Laki';
            case static::JENIS_KELAMIN_PEREMPUAN:
               return 'Perempuan';
            default:
                return '';
        }
    }

    /**
     * 
     */
    public static function getAgamaMeaning($agama)
    {
        switch ($agama) {
            case static::AGAMA_ISLAM:
               return 'Islam';
            case static::AGAMA_KATOLIK:
               return 'Katolik';
            case static::AGAMA_KONGHUCU:
               return 'Konghucu';
            case static::AGAMA_BUDHA:
               return 'Budha';
            case static::AGAMA_KRISTEN:
               return 'Kristen';
            default:
                return '';
        }
    }

    public function user()
    {
        return $this->hasOne('App\Model\User\User');
    }
}
