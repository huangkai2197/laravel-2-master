<?php

namespace App\Models\Csl;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class  Record extends Model
{
    protected $table = "teaching_inspection_info";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];



    /*
     * 期末实验教学检查记录信息展示
     */
    public static function qmshow(){
        try {
            $res= self::join('laboratory','laboratory.laboratory_id','teaching_inspection_info.laboratory_id')
                ->select('info_id','teaching_inspection_info.laboratory_id','class_name','teacher','teach_operating_condition','operating_condition','remark','laboratory_name')
                ->get();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}

    /*
     * 期末实验教学检查记录修改
     */
    public static function qmchange($info_id,$laboratory_id,$class_name,$teacher, $teach_operating_condition, $operating_condition,$remark){
        try {
            $res=self::where('info_id',$info_id)
                ->update([
                    'laboratory_id'=>$laboratory_id,
                    'class_name'=>$class_name,
                    'teacher'=>$teacher,
                    'teach_operating_condition'=>$teach_operating_condition,
                    'operating_condition'=>$operating_condition,
                    'remark'=>$remark,
                ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('修改错误', [$e->getMessage()]);
            return false;
        }}

    /*
     * 期末实验教学检查记录删除
     */
    public static function qmdelete($info_id){
        try {
            $res=self::where('info_id',$info_id)
                ->delete();
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}
    /*
    * 期末实验教学检查记录增加
    */
    public static function qmadd($laboratory_id,$class_name,$teacher, $teach_operating_condition, $operating_condition,$remark){
        try {
            $res=self::create([
                'laboratory_id'=>$laboratory_id,
                'class_name'=>$class_name,
                'teacher'=>$teacher,
                'teach_operating_condition'=>$teach_operating_condition,
                'operating_condition'=>$operating_condition,
                'remark'=>$remark,
            ]);
            return $res ?
                $res :
                false;
        }catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }}


}
