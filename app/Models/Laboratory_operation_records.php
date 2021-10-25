<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory_operation_records extends Model
{
    protected $table='laboratory_operation_records';
    protected $primaryKey='form_id';
    public  $timestamps=true;
    protected $guarded = [];

    /**
     * 运行记录的增加
     * @author oys
     * @param $form_id
     * @param $laboratory_id
     * @param $week
     * @param $time
     * @param $class_id
     * @param $number
     * @param $class_name
     * @param $class_type
     * @param $teacher
     * @param $situation
     * @param $remark
     * @return false
     */
    public static function AddLabrun($form_id,$laboratory_id,$week,$time,$class_id,$number,$class_name,$class_type,$teacher,$situation,$remark)
    {
        try {
            //设备表成功
            $res=self::create(
                [
                    'form_id'=>$form_id,
                    'laboratory_id'=>$laboratory_id,
                    'week'=>$week,
                    'time'=>$time,
                    'class_id'=>$class_id,
                    'number'=>$number,
                    'class_name'=>$class_name,
                    'class_type'=>$class_type,
                    'teacher'=>$teacher,
                    'situation'=>$situation,
                    'remark'=>$remark,
                ]
            );
            return $res;
        }catch (\Exception $e){
            logError('运行记录录入成功',[$e->getMessage()]);
            return false;
        }
    }



    /**
     * 运行记录的的删除
     * @author oys
     * @param $records_id
     * @return false
     */
    public static function DeleteEquipment($form_id)
    {
        try {
            //设备表成功
            $res=self::where('form_id',$form_id)->delete();
            return $res;
        }catch (\Exception $e){
            logError('运行记录删除成功',[$e->getMessage()]);
            return false;
        }
    }




    /**
     * 运行记录的的修改
     * @author oys
     * @param $records_id
     * @param $laboratory_id
     * @param $week
     * @param $time
     * @param $class_id
     * @param $number
     * @param $class_name
     * @param $class_type
     * @param $teacher
     * @param $situation
     * @param $remark
     * @return false
     */
    public static function UpdateLabrun($form_id,$laboratory_id,$week,$time,$class_id,$number,$class_name,$class_type,$teacher,$situation,$remark)
    {
        try {
            $res=self::where('form_id',$form_id)->
            update([
                'laboratory_id'=>$laboratory_id,
                'week'=>$week,
                'time'=>$time,
                'class_id'=>$class_id,
                'number'=>$number,
                'class_name'=>$class_name,
                'class_type'=>$class_type,
                'teacher'=>$teacher,
                'situation'=>$situation,
                'remark'=>$remark,
            ]);
            return $res;
        }catch (\Exception $e){
            logError('设备修改成功',[$e->getMessage()]);
            return false;
        }
    }



    /**
     * 运行记录表的查看
     * @author oys
     * @param $form_id
     * @return false
     */
    public static function SelectLabrun($form_id)
    {
        try {
            //设备表成功
            $res=self::where('form_id',$form_id)->get();
            return $res;
        }catch (\Exception $e){
            logError('运行记录查看成功',[$e->getMessage()]);
            return false;
        }
    }


}
