<?php

namespace App\Model\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Authenticatable
{
    use HasRoles;

    protected $table        = 'tbl_user';
    protected $guard_name   = 'web';

    const USER_STATUS_ACTIVE        = 10;
    const USER_STATUS_NOT_ACTIVE    = 20;

    const ACCOUNT_TYPE_CREATOR  = 10;
    const ACCOUNT_TYPE_ADMIN    = 20;
    const ACCOUNT_TYPE_EMPLOYEE = 30;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','address', 'full_name','account_type','status','profile_picture'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'account_type' => self::ACCOUNT_TYPE_ADMIN,
        'status' => self::USER_STATUS_ACTIVE
    ];

    public static $rules = [
        'username' => 'required | unique',
        'profile_picture' => 'string',
        'address' => 'string',
        'full_name' => 'required | string',
        'account_type' => 'required | integer',
        'status' => 'required | integer'
    ];

     /**
     * get active user
     */
     public static function getUser()
     {
        return self::where('status',self::USER_STATUS_ACTIVE)->whereNotIn('account_type', [User::ACCOUNT_TYPE_CREATOR])->get();
     }

     /**
     * get active user
     */
     public static function getUserEmployee()
     {
        return self::where('status',self::USER_STATUS_ACTIVE)->where('account_type', [User::ACCOUNT_TYPE_EMPLOYEE])->get();
     }

    
     /**
     * 
     */
     public static function passwordChangeValidation($old_password, $curent_password)
     {
        if(Hash::check($old_password, $curent_password)) 
        { 
            return true;
        }

        return false;
     }
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @var array
     */
    public static function userByUsername($username)
    {
        $data = static::where('username', $username)->where('status', static::USER_STATUS_ACTIVE)->first();
        return $data;
    } 

    /**
     * 
     */
    public static function getAccountMeaning($acount)
    {
        switch ($acount) {
            case static::ACCOUNT_TYPE_CREATOR:
               return 'Creator';
            case static::ACCOUNT_TYPE_ADMIN:
               return 'Admin';
            case static::ACCOUNT_TYPE_EMPLOYEE:
               return 'Employee';
            default:
                return '';
        }
    }

    /**
     * Get the employee record associated with the user.
     */
    public function employee()
    {
        return $this->hasOne('App\Model\User\UserEmployee');
    }
}
