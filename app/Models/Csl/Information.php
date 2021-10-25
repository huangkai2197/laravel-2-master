<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Information extends Model
{
    protected $table = "admin";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function look($id){
        try {
            $res= self::where('id',$id)
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

    //找出管理员的类型
    public static function selecttype($id){
        try {
            $res=self::where('id',$id)
                ->value('type');

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    //找出管理员的名字
    public static function selectname($id){
        try {
            $res=self::where('id','=',$id)
                ->value('name');

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}



}
