<?php

namespace App\Models;

use App\Models\Imformatioin;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends \Illuminate\Foundation\Auth\User implements JWTSubject,Authenticatable
{
    //
    use Notifiable;

    public $table = 'superadmin';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable = [ 'password', 'name', 'phone','email','account'];
    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return self::getKey();
    }

    /**
     * 创建用户
     *
     * @param array $array
     * @return |null
     * @throws \Exception
     */
    public static function createUser($array = [])
    {
        try {
            $student_id = self::create($array)->id;
            //echo "student_id:" . $student_id;
            return $student_id ?
                $student_id :
                false;
        } catch (\Exception $e) {
            logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
            return false;
        }
    }

    /**
     * 存储基本信息表
     * @param $request
     */
    public static function saveImformation($request, $student_id)
    {
        try {
            $res = Imformatioin::create(
                [
                    'student_id' => $student_id,
                    'student_name' => $request['student_name'],
                    'student_email' => $request['student_email'],
                    'student_phone' => $request['student_phone'],

                ]
            );
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('存储个人信息失败！', [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 查询该工号是否已经注册
     * 返回该工号注册过的个数
     * @param $request
     * @return false
     */
    public static function checknumber($request)
    {
        $student_job_number = $request['account'];
        try{
            $count = User::select('account')
                ->where('account',$student_job_number)
                ->count();
            //echo "该账号存在个数：".$count;
            //echo "\n";
            return $count;
        }catch (\Exception $e) {
            logError("账号查询失败！", [$e->getMessage()]);
            return false;
        }
    }


    protected $attributes = array();

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * 从token中获取id
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // Return the name of unique identifier for the user (e.g. "id")

        return 'id';
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // Return the unique identifier for the user (e.g. their ID, 123)
        $identifier_name = $this->getAuthIdentifierName();
        return $this->attributes[$identifier_name];
    }

    /**
     * 修改super密码
     * @param $request
     */
    public static function update1($account,$password)
    {
        try {
            $res=self::where('account',$account)->update([
                'password'=>$password

            ]);
            return $res;
        } catch (\Exception $e) {
            logError('存储个人信息失败！', [$e->getMessage()]);
            return false;
        }
    }

}
