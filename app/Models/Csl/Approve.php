<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Approve extends Model
{
    protected $table = "approve";
    public $timestamps = true;
    protected $guarded = [];

    /**
     * //借用部门负责人否决原因的存入
     * @param $form_id
     * @param $reason
     * @return false
     */
    public static function approve1($form_id,$reason,$name){
        try {

            $res=self::where('form_id',$form_id)
                ->update([
                    'reason'=>$reason,
                    'borrowing_department_name'=>$name
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /**
     * //普通管理员否决原因的存入
     * @param $form_id
     * @param $reason
     * @return false
     */

    public static function approve2($form_id,$reason,$name){
        try {

            $res=self::where('form_id',$form_id)
                ->update([
                    'reason'=>$reason,
                    'borrowing_manager_name'=>$name
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /**
     * //中心主任否决原因的存入
     * @param $form_id
     * @param $reason
     * @return false
     */
    public static function approve3($form_id,$reason,$name){
        try {

            $res=self::where('form_id',$form_id)
                ->update([
                    'reason'=>$reason,
                    'center_director_name'=>$name
                ]);

            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
}
