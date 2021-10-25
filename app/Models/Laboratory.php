<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class Laboratory extends Model
{
    public $timestamps = true;
    public $table = 'laboratory';
    protected $guarded = [];
    protected $primaryKey = "laboratory_id";

    /***
     * yjx
     * 查看实验室
     * @param $laboratory_id
     * @return false
     */
    public static function show($laboratory_id){
        try {
            $res = Laboratory::where('laboratory_id','=',$laboratory_id)->get();
            return $res ?
                $res :
                false;

        } catch (Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }

    }

    /***
     * yjx
     * 查询所有实验室
     * @return false
     */
    public static function showall(){
        try {
            $res=self::get();
            return $res;
        } catch (\Exception $e) {
            logError('搜索错误！', [$e->getMessage()]);
            return false;
        }

    }
}
