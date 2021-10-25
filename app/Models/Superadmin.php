<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Superadmin extends Model
{

    public $table = 'superadmin';
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = "id";

    /***
     * yjx
     * 获取超管信息
     * @param $account
     * @return false
     */
    public static function show($account)
    {
        try {
            $res = Superadmin::where('account', $account)->get();
            return $res ?
                $res :
                false;

        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
